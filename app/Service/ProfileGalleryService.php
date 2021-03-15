<?php

namespace App\Service;

use App\Models\Gallery;

class ProfileGalleryService
{
    static function addProfileImages($matches)
    {
        for ($x = 0; $x < count($matches); $x++) {

            $photos = Gallery::select('photo')->where('user_id', $matches[$x]->user_id)->get();
            $filtered = [];

            if (count($photos) > 0) {
                foreach ($photos as $photo) {
                    $filtered[] = $photo->photo;
                }
                $matches[$x]->photos = $filtered;
            }
        }
        return $matches;
    }
}