<?php

namespace App\Requests;

class RequestHandler
{
    public static function getParam($request, $key, $default = null)
    {
        $postParams = $request->getParsedBody();
        $getParams = $request->getQueryParams();
        $getBody = json_decode($request->getBody(), true);
        $result = $default;

        if (is_array($postParams) && isset($postParams[$key])) {
            $result = $postParams[$key];
        } elseif (is_object($postParams) && property_exists($postParams, $key)) {
            $result = $postParams->$key;
        } elseif (is_array($getBody) && isset($getBody[$key])) {
            $result = $getBody[$key];
        } elseif (isset($getParams[$key])) {
            $result = $getParams[$key];
        }
        return $result;
    }

}