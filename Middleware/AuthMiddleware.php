<?php

namespace Middlware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use WP_Error;

class AuthMiddleware
{

    public function my_plugin_verify_jwt()
    {
        $authHeader = '';

        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }

        if (!$authHeader) {
            return new WP_Error(
                'jwt_missing',
                'Authorization header missing',
                ['status' => 401]
            );
        }

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return new WP_Error(
                'jwt_invalid',
                'Invalid Authorization format',
                ['status' => 401]
            );
        }

        $token = $matches[1];

        try {
            $decoded = JWT::decode($token, new Key(JWT_AUTH_SECRET_KEY, 'HS256'));

            $token_iss = rtrim($decoded->iss, '/');
            $site_url = rtrim(home_url(), '/');

            if ($token_iss !== $site_url) {
                return new WP_Error(
                    'jwt_auth_bad_iss',
                    sprintf('Token issuer mismatch. Expected: %s, Got: %s', $site_url, $token_iss),
                    ['status' => 403]
                );
            }

            $GLOBALS['jwt_user'] = $decoded;

            return true;
        } catch (\Throwable $e) {
            return new WP_Error(
                'jwt_invalid',
                'Invalid or expired token: ' . $e->getMessage(),
                ['status' => 401]
            );
        }
    }
}
