<?php

namespace App\Service;

class ResponseService
{
    static function isTokenResponse($response, $msg)
    {
        $msg = json_encode(["success" => true, "token" => $msg]);
        $response->getBody()->write($msg);
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    static function is200Response($response, $msg)
    {
        $msg = json_encode(["success" => true, "response" => $msg]);
        $response->getBody()->write($msg);
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    static function is400Response($response, $msg)
    {
        $msg = json_encode(["success" => false, "response" => $msg]);
        $response->getBody()->write($msg);
        return $response->withHeader("Content-Type", "application/json")->withStatus(400);
    }

    static function is422Response($response, $msg)
    {
        $msg = json_encode(["success" => true, "response" => $msg]);
        $response->getBody()->write($msg);
        return $response->withHeader("Content-Type", "application/json")->withStatus(422);
    }
}