<?php

return function ($container) {

    $container["LoginController"] = function () {
        return new \App\Controllers\LoginController;
    };

    $container["CreateUserController"] = function () {
        return new \App\Controllers\CreateUserController;
    };

    $container["SwipeController"] = function () {
        return new \App\Controllers\SwipeController;
    };

    $container["ProfileController"] = function () {
        return new \App\Controllers\ProfileController;
    };

    $container["GalleryUserController"] = function () {
        return new \App\Controllers\GalleryUserController;
    };
};
