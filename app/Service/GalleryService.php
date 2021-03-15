<?php

namespace App\Service;

class GalleryService
{
    static function cropJpgImage($uploadPath, $extension, $tempName)
    {
        $basename = bin2hex(random_bytes(12));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $fileinfo = $uploadPath . DIRECTORY_SEPARATOR . $filename;
        $temp = $uploadPath . DIRECTORY_SEPARATOR . $tempName;
        $image = imagecreatefromjpeg($temp);

        $thumb_width = 100;
        $thumb_height = 100;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        } else {
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        imagecopyresampled($thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center horizontally
            0 - ($new_height - $thumb_height) / 2, // Center vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height);

        imagejpeg($thumb, $fileinfo, 80);

        imagedestroy($thumb);
        imagedestroy($image);
        unlink($temp);

        return self::getDomain().$filename;
    }

    static function getDomain(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return  $protocol . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR;
    }
}