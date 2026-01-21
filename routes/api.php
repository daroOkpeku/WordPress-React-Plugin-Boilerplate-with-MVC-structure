<?php
// this where api route will be

namespace routes;

require_once plugin_dir_path(__FILE__) . "../Controller/AuthController.php";
require_once plugin_dir_path(__FILE__) . "../Middleware/AuthMiddleware.php";

use Controller\AuthController;
use Middlware\AuthMiddleware;


class API
{


    public function __construct()
    {
        add_action('rest_api_init',  function () {
            $this->handle_register();
            $this->handle_login();
            $this->handle_protected();
        }, 10);
    }



    public function handle_register()
    {
        // http://localhost/wordpress-React/wp-json/great_react/v1/register

        $auth = new AuthController();
        register_rest_route("great_react/v1", "register", [
            'methods' => 'POST',
            'callback' => [$auth, 'create_users'], //create_users is the function in AuthController
            'permission_callback' => '__return_true',
            'args' => [
                'user_nicename' => [
                    'required' => true,
                    'sanitize_callback' => 'sanitize_text_field',
                ],
                'user_login' => [
                    'required' => true,
                    'sanitize_callback' => 'sanitize_user',
                ],
                'user_email' => [
                    'required' => true,
                    'sanitize_callback' => 'sanitize_email',
                    'validate_callback' => 'is_email'
                ],
                'user_pass' => [
                    'required' => true,
                ]
            ]
        ]);
    }


    public function handle_login()
    {
        $auth = new AuthController();
        register_rest_route("great_react/v1", "login", [
            'methods' => 'POST',
            'callback' => [$auth, 'login_users'],
            'permission_callback' => '__return_true',
            'args' => [
                'user_email' => [
                    'required' => true,
                    'sanitize_callback' => 'sanitize_email',
                    'validate_callback' => 'is_email'
                ],
                'user_pass' => [
                    'required' => true,
                ]
            ]
        ]);
    }

    public function handle_protected()
    {

        $auth = new AuthController();
        $authmiddleware = new AuthMiddleware();
        register_rest_route('great_react/v1', 'protected', [
            'methods' => 'GET',
            'callback' => [$auth, 'my_plugin_protected_route'],
            // 'permission_callback' => '__return_true',
            //'permission_callback' => [$this, 'my_plugin_verify_jwt'],
            'permission_callback' => [$authmiddleware, 'my_plugin_verify_jwt'] //middleware
        ]);
    }
}
