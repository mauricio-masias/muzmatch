<?php

namespace App\Controllers;

use App\Interfaces\SecretKeyInterface;
use \Firebase\JWT\JWT;

class TokenController implements SecretKeyInterface
{
    public static function generateToken($email)
    {
        $iat = time();
        $exp = strtotime('+1 hour', $iat);
        $secret = TokenController::JWT_KEY;

        $payload = [
            "jti" => $email,
            "iat" => $iat,
            "exp" => $exp
        ];

        return JWT::encode($payload, $secret, "HS256");
    }

    public static function decodeToken()
    {
        $jwt = self::getBearerToken();
        $secret = TokenController::JWT_KEY;
        $payload = JWT::decode($jwt, $secret, ["HS256"]);
        return $payload->jti;
    }

    static function getBearerToken()
    {
        $headers = self::getAuthorizationHeader();
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
    }

    static function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));

            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
}