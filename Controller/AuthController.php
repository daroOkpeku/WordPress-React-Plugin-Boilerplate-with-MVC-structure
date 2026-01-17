<?php

namespace Controller;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use Firebase\JWT\JWT; //second option with jwt plugin
use Firebase\JWT\Key;




if (!defined('JWT_AUTH_SECRET_KEY')) {
    define('JWT_AUTH_SECRET_KEY', 'your-super-secret-key-change-this-in-production');
}

class AuthController
{


    public function create_users(WP_REST_Request $request)
    {
        global $wpdb;

        $table = $wpdb->prefix . "users";
        $param  = $request->get_params();

        $user_nicename = isset($param['user_nicename']) ? sanitize_text_field($param['user_nicename']) : "";
        $user_login = isset($param['user_login']) ? sanitize_text_field($param['user_login']) : "";
        $user_email = isset($param['user_email']) ? sanitize_email($param['user_email']) : "";
        $user_pass = isset($param['user_pass']) ? sanitize_text_field($param['user_pass']) : "";

        if (empty($user_nicename)) {
            $message = 'user_nicename are required fields.';
            if (wp_doing_ajax()) {
                wp_send_json_error($message);
            } else {
                return new WP_Error(
                    'missing_fields',
                    $message,
                    array('status' => 400)
                );
            }
        }


        if (empty($user_login)) {
            $message = 'user_login are required fields.';
            if (wp_doing_ajax()) {
                wp_send_json_error($message);
            } else {
                return new WP_Error(
                    'missing_fields',
                    $message,
                    array('status' => 400)
                );
            }
        }


        if (!is_email($user_email)) {
            $message = 'user_email are required fields.';
            if (wp_doing_ajax()) {
                wp_send_json_error($message);
            } else {
                return new WP_Error(
                    'missing_fields',
                    $message,
                    array('status' => 400)
                );
            }
        }


        $result = $wpdb->insert($table, [
            'user_nicename' => $user_nicename,
            'user_login' => $user_login,
            'user_email' => $user_email,
            'user_pass' => password_hash($user_pass, PASSWORD_DEFAULT),
            'user_url' => 'http://localhost/wordpress-React',
            'display_name' => $user_login,
            'user_registered' => current_time('mysql')
        ]);

        if ($result === false) {
            $error_message = 'Failed to save to database: ' . $wpdb->last_error;
            error_log('Database error: ' . $error_message);

            if (wp_doing_ajax()) {
                wp_send_json_error($error_message);
            } else {
                return new WP_Error(
                    'db_insert_error',
                    $error_message,
                    array('status' => 500)
                );
            }
        }

        $success_response = array(
            'success' => true,
            'message' => 'User created successfully',
            'id' => $wpdb->insert_id
        );

        return new WP_REST_Response($success_response, 200);
    }


    public function login_users(WP_REST_Request $request)
    {
        global $wpdb;

        $param  = $request->get_params();
        $user_email = isset($param['user_email']) ? sanitize_email($param['user_email']) : "";
        $user_pass = isset($param['user_pass']) ? sanitize_text_field($param['user_pass']) : "";

        $user  = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM wp_users WHERE user_email=%s", $user_email)
        );

        if (!$user) {
            $error_response = array(
                'error' => true,
                'message' => 'User does not exist',
            );
            return new WP_REST_Response($error_response, 200);
        }

        if ($user && password_verify($user_pass, $user->user_pass)) {

            $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : 'your-secret-key';
            $issued_at = time();
            $expiration_time = $issued_at + (DAY_IN_SECONDS);


            $payload = [
                'iss' => rtrim(home_url(), '/'),
                'iat' => $issued_at,
                'nbf' => $issued_at,
                'exp' => $expiration_time,
                'data' => [
                    'user' => [
                        'id' => $user->ID
                    ]
                ]
            ];

            $token = JWT::encode($payload, $secret_key, 'HS256');

            $success_response = array(
                'success' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => [
                    'ID' => $user->ID,
                    'user_email' => $user->user_email,
                    'user_login' => $user->user_login,
                    'user_nicename' => $user->user_nicename,
                ]
            );
            return new WP_REST_Response($success_response, 200);
        } else {
            $error_response = array(
                'error' => true,
                'message' => 'Please enter the correct credentials',
            );
            return new WP_REST_Response($error_response, 200);
        }
    }


    function my_plugin_protected_route()
    {
        $jwt = $GLOBALS['jwt_user'];

        $user_id = null;

        if (isset($jwt->data->user->id)) {
            // Plugin structure: data.user.id
            $user_id = $jwt->data->user->id;
        } elseif (isset($jwt->user_id)) {
            // Your structure: user_id
            $user_id = $jwt->user_id;
        }

        $response = [
            'message' => 'You have access to this protected route',
            'user_id' => $user_id,
        ];

        return new WP_REST_Response($response, 200);
    }
}
