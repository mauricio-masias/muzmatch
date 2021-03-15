<?php


namespace App\Controllers;

use App\Models\User;
use App\Requests\RequestHandler;
use App\Service\ResponseService;
use App\Service\ValidatorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use Respect\Validation\Validator as v;


class LoginController
{
    public function Login(Request $request, Response $response)
    {
        $validator = new ValidatorService();
        $validator->validate($request, [
            "email" => v::notEmpty()->email(),
            "password" => v::notEmpty()
        ]);

        if ($validator->failed()) {
            $msg = "Incorrect data structure";
            return ResponseService::is400Response($response, $msg);
        } else {

            $status = $this->verifyAccount(
                RequestHandler::getParam($request, "password"),
                RequestHandler::getParam($request, "email")
            );

            if ($status === false) {
                $msg = "Invalid username or password";
                return ResponseService::is400Response($response, $msg);
            } else {
                $msg = TokenController::generateToken(RequestHandler::getParam($request, "email"));
                return ResponseService::isTokenResponse($response, $msg);
            }
        }
    }

    private function verifyAccount($password, $email)
    {
        if ($this->EmailExist($email)) {
            $user = User::select('password')->where("email", $email)->get();
            return (password_verify($password, $user[0]->password) == false) ? false : true;
        } else {
            return false;
        }
    }

    private function EmailExist($email)
    {
        $count = User::where("email", $email)->count();
        return ($count == 0) ? false : true;
    }
}