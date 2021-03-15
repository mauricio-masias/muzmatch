<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $fillable = ["name", "lname", "email", "password", "active"];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}