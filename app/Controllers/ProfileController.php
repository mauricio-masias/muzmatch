<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Requests\RequestHandler;
use App\Service\ResponseService;
use App\Service\ProfileFilterService;
use App\Service\ProfileSortService;
use App\Service\ProfileGalleryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;


class ProfileController
{
    public function fetchProfile(Request $request, Response $response)
    {
        $user = User::find(RequestHandler::getParam($request, "id"))->profile;

        if ($user) {

            $matches = Profile::select('id', 'user_id', 'gender', 'age', 'location', 'attraction', 'likes', 'dislikes')
                ->where("user_id", '!=', $user->id);

            $matches = ProfileFilterService::filterSearch($request, $matches, $user);
            $matches = ProfileSortService::sortSearch($request, $matches, $user);
            $matches = $matches->get();

            $matches = ProfileGalleryService::addProfileImages($matches);

            return ResponseService::is200Response($response, $matches);
        } else {
            $this->responseError($response);
        }
    }

    private function responseError($response): string
    {
        $msg = "Cannot find user with provided ID. Please try again.";
        return ResponseService::is400Response($response, $msg);
    }
}