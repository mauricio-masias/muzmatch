<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profile";
    protected $fillable = ["user_id", "gender", "age", "location", "attraction", "likes", "dislikes"];

    public function images()
    {
        return $this->morphToMany(Gallery::class, 'images');
    }
}