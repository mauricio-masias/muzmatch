<?php

namespace App\Service;

use App\Requests\RequestHandler;
use App\Models\Pair;
use App\Service\ValidatorService;
use Respect\Validation\Validator as v;

class ProfileFilterService
{
    static function filterSearch($request, $matches, $user): object
    {
        $matches_filtered = self::filterByAge($request, $matches, $user);
        $matches_filtered = self::filterByGender($request, $matches_filtered, $user);
        $matches_filtered = self::filterByAlreadySwiped($matches_filtered, $user);
        return $matches_filtered;
    }

    static function filterByAlreadySwiped($matches, $user): object
    {
        $exclude_ids = [];
        $already_swiped = Pair::select('match_user_id')
            ->where("user_id", $user->id)
            ->get();

        foreach ($already_swiped as $swiped) {
            $exclude_ids[] = $swiped->match_user_id;
        }

        if (count($exclude_ids) > 0) {
            $matches = $matches->whereNotIn("user_id", $exclude_ids);
        }
        return $matches;
    }

    static function filterByAge($request, $matches, $user): object
    {
        $validator = new ValidatorService();
        $validator->validate($request, [
            "filter_age" => v::notEmpty(),
            "age_range" => v::notEmpty()
        ]);
        $filter_age = ($validator->failed()) ? 0 : RequestHandler::getParam($request, "filter_age");
        $age_range = ($validator->failed()) ? 10 : RequestHandler::getParam($request, "age_range");

        if (((int)$filter_age !== 0)) {
            $search_age_gap_bottom = (((int)$user->age - (int)$age_range) >= 18) ? (int)$user->age - (int)$age_range : 18;
            $search_age_gap_top = $user->age + 10;

            $matches = $matches->where("age", '>=', $search_age_gap_bottom)
                ->where("age", '<=', $search_age_gap_top);
        }
        return $matches;
    }

    static function filterByGender($request, $matches, $user): object
    {
        $validator = new ValidatorService();
        $validator->validate($request, [
            "filter_gender" => v::notEmpty(),
            "gender_preference" => v::notEmpty()
        ]);
        $filter_gender = ($validator->failed()) ? 0 : RequestHandler::getParam($request, "filter_gender");
        $gender_preference = ($validator->failed()) ? 0 : RequestHandler::getParam($request, "gender_preference");

        if (((int)$filter_gender !== 0)) {
            $search_gender = ($gender_preference == 0) ?
                (($user->gender == 'Male') ? 'Female' : 'Male') :
                ucwords($gender_preference);

            $matches = $matches->where("gender", $search_gender);
        }
        return $matches;
    }
}