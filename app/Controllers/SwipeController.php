<?php

namespace App\Controllers;

use App\Service\ResponseService;
use App\Service\SwipeService;
use App\Service\AttractionService;
use App\Requests\RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use App\Service\ValidatorService;
use Respect\Validation\Validator as v;

class SwipeController
{
    public function swipeProfile(Request $request, Response $response)
    {
        $validator = new ValidatorService();
        $validator->validate($request, [
            "user_id" => v::notEmpty(),
            "profile_id" => v::notEmpty(),
            "preference" => v::notEmpty()
        ]);

        if (!$validator->failed()) {
            $match_user_id = SwipeService::findMatchProfileUser($request);

            if (SwipeService::storeSwipe($request, $match_user_id)) {

                if (RequestHandler::getParam($request, "preference") == 'Yes') {
                    AttractionService::increaseAttraction($request);
                    $match = SwipeService::checkForMatch($request, $match_user_id);
                    return ResponseService::is200Response($response, (object)['match' => ($match === 1) ? 'Yes' : 'No']);

                } else {
                    AttractionService::decreaseAttraction($request);
                    return ResponseService::is200Response($response, (object)['match' => 'No']);
                }

            } else {
                $msg = "Cannot save user preference, already exists";
                return ResponseService::is400Response($response, $msg);
            }

        } else {
            $msg = "Incorrect request structure";
            return ResponseService::is400Response($response, $msg);
        }
    }
}