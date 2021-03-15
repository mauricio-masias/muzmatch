<?php

namespace App\Service;

use App\Requests\RequestHandler;
use App\Models\Pair;
use App\Service\ValidatorService;
use Respect\Validation\Validator as v;

class ProfileSortService
{
    static function sortSearch($request, $matches, $user): object
    {
        $matches_sorted = self::sortByLocation($request, $matches, $user);
        $matches_sorted = self::sortByAttractiveness($request, $matches_sorted);
        return $matches_sorted;
    }

    static function sortByLocation($request, $matches, $user): object
    {
        $validator = new ValidatorService();
        $validator->validate($request, ["sort_location" => v::notEmpty()]);
        $filter_location = ($validator->failed()) ? 0 : RequestHandler::getParam($request, "sort_location");

        if (((int)$filter_location !== 0)) {
            $matches = $matches->orderByRaw("FIELD(location, '$user->location') DESC");
        }
        return $matches;
    }

    static function sortByAttractiveness($request, $matches): object
    {
        $validator = new ValidatorService();
        $validator->validate($request, ["sort_attraction" => v::notEmpty()]);
        $sort_attraction = ($validator->failed()) ? 0 : RequestHandler::getParam($request, "sort_attraction");

        if (((int)$sort_attraction !== 0)) {
            $matches = $matches->orderBy("attraction", "DESC");
        }
        return $matches;
    }


}