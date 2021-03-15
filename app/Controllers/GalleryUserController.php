<?php

namespace App\Controllers;

use App\Service\ResponseService;
use App\Service\GalleryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use App\Models\User;
use App\Models\Gallery;


class GalleryUserController
{
    protected $uploadDir = 'uploads';
    protected $croppedImages = [];

    public function addUserPhoto(Request $request, Response $response)
    {
        $uploadPath = realpath(__DIR__ . '/../../' . $this->uploadDir);
        $uploadedFiles = $request->getUploadedFiles();

        if (is_array($uploadedFiles['api_image'])) {

            foreach ($uploadedFiles['api_image'] as $uploadedFile) {
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

                    if ($extension === 'jpg') {
                        $tempName = $uploadedFile->getClientFilename();
                        $uploadedFile->moveTo($uploadPath . DIRECTORY_SEPARATOR . $tempName);
                        $this->croppedImages[] = GalleryService::cropJpgImage($uploadPath, $extension, $tempName);
                    }
                }
            }
            $user_id = $this->updateUserProfile($this->croppedImages);
            $this->buildResponse($user_id, $this->croppedImages, $response);

        } else {

            $uploadedFile = $uploadedFiles['api_image'];

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

                if ($extension === 'jpg') {
                    $tempName = $uploadedFile->getClientFilename();
                    $uploadedFile->moveTo($uploadPath . DIRECTORY_SEPARATOR . $tempName);
                    $croppedImage = GalleryService::cropJpgImage($uploadPath, $extension, $tempName);
                    $user_id = $this->updateUserProfile([$croppedImage]);
                    $this->buildResponse($user_id, [$croppedImage], $response);
                } else {
                    $msg = "Only JPEG format allowed";
                    return ResponseService::is400Response($response, $msg);
                }
            }
        }
    }

    private function buildResponse($id, $images, $response): string
    {
        $info = (object)[
            'user_id' => $id,
            'image_url' => (count($images) > 1) ? $images : $images[0]
        ];
        return ResponseService::is200Response($response, $info);
    }

    private function getUserId(): int
    {
        $userEmail = TokenController::decodeToken();
        $user = User::where('email', $userEmail)->get();
        return $user[0]->id;
    }

    private function updateUserProfile($images): int
    {
        $user_id = $this->getUserId();
        foreach ($images as $image) {
            Gallery::create([
                "user_id" => $user_id,
                "photo" => $image
            ]);
        }
        return $user_id;
    }
}