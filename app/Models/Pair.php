<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    protected $table = "pair";
    protected $fillable = ["user_id", "match_user_id", "status"];
}