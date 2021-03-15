<?php

namespace App\Service;

use App\Models\Pair;
use App\Models\Profile;
use App\Requests\RequestHandler;

class SwipeService
{
    static function findMatchProfileUser($request): int
    {
        $profile = Profile::select('user_id')
            ->where("id", RequestHandler::getParam($request, "profile_id"))
            ->get();
        return $profile[0]->user_id;
    }

    static function storeSwipe($request, $match_user_id): bool
    {
        if (!self::checkIfSwipeExist($request, $match_user_id)) {
            $match = Pair::create([
                "user_id" => RequestHandler::getParam($request, "user_id"),
                "match_user_id" => $match_user_id,
                "status" => (RequestHandler::getParam($request, "preference") == 'Yes') ? 1 : 0
            ]);
            return isset($match->id);
        } else {
            return false;
        }
    }

    static function checkIfSwipeExist($request, $match_user_id): bool
    {
        $exist = Pair::select('id')
            ->where("user_id", RequestHandler::getParam($request, "user_id"))
            ->where("match_user_id", $match_user_id)
            ->get();
        return (count($exist) > 0);
    }

    static function checkForMatch($request, $match_user_id): int
    {
        $match = Pair::select('id', 'status')
            ->where("user_id", $match_user_id)
            ->where("match_user_id", RequestHandler::getParam($request, "user_id"))
            ->get();
        return (count($match) > 0) ? $match[0]->status : 0;
    }
}