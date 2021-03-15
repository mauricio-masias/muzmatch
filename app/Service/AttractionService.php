<?php

namespace App\Service;

use App\Models\Profile;
use App\Requests\RequestHandler;

class AttractionService
{
    static function increaseAttraction($request): void
    {
        $profile = Profile::find(RequestHandler::getParam($request, "profile_id"));
        $new_score = ((int)$profile->attraction >= 100) ?
            100 :
            (int)$profile->attraction + 1;

        $profile->attraction = $new_score;
        $profile->likes = $profile->likes + 1;
        $profile->save();
    }

    static function decreaseAttraction($request): void
    {
        $profile = Profile::find(RequestHandler::getParam($request, "profile_id"));
        $new_score = ((int)$profile->attraction <= 0) ?
            0 :
            (int)$profile->attraction - 1;

        $profile->attraction = $new_score;
        $profile->dislikes = $profile->dislikes + 1;
        $profile->save();
    }
}