<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Service\ResponseService;
use App\Service\RandomGeneratorService as Rand;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

class CreateUserController
{
    public function createUser(Request $request, Response $response)
    {
        $age = Rand::getRandomAge();
        $gender = Rand::getRandomGender();
        $name = Rand::getRandomName($gender);
        $lname = Rand::getRandomLastName();
        $email = Rand::getRandomEmail($name, $lname);
        $password = Rand::getRandomPassword();
        $passSha = Rand::generateHashPassword($password);
        $location = Rand::getLocation();

        $new_user = User::create([
            "name" => addslashes($name),
            "lname" => addslashes($lname),
            "email" => $email,
            "password" => $passSha,
        ]);

        if ((int)$new_user->id > 0) {
            $new_profile = Profile::create([
                "user_id" => $new_user->id,
                "gender" => $gender,
                "age" => $age,
                "location" => addslashes($location),
                "attraction" => 50, // range 1 - 100
            ]);

            if ((int)$new_profile->id > 0) {
                $info = (object)[
                    'id' => $new_user->id,
                    'name' => $name . ' ' . $lname,
                    'email' => $email,
                    'password' => $password,
                    'gender' => $gender,
                    'age' => $age,
                    'location' => $location
                ];
                ResponseService::is200Response($response, $info);

            } else {
                $this->responseError($response);
            }
        } else {
            $this->responseError($response);
        }
    }

    private function responseError($response): string
    {
        $msg = "Cannot create a new user. Please try again.";
        return ResponseService::is400Response($response, $msg);
    }
}