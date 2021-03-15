<?php

$container["errorHandler"] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $response->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(
                array(
                    "success" => false,
                    "error" => "SERVER ERROR",
                    "message" => "Opps, something went wrong",
                    "status_code" => "500",
                    'trace' => $exception->getTraceAsString()
                ),
                JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            ));
    };
};

$container["notFoundHandler"] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(
                array(
                    "success" => false,
                    "error" => "NOT FOUND",
                    "message" => "Route doesn't exist",
                    "status_code" => "404",
                ),
                JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            ));
    };
};

$container["notAllowedHandler"] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $response->withStatus(405)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(
                array(
                    "success" => false,
                    "error" => "NOT ALLOWED",
                    "message" => "Request not allowed",
                    "status_code" => "405",
                ),
                JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            ));
    };
};

$container['phpErrorHandler'] = function ($container) {
    return $container["errorHandler"];
};