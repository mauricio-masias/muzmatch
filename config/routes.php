<?php

$app->group("/user", function () use ($app) {
    $app->post("/create", "CreateUserController:createUser");
    $app->post("/gallery", "GalleryUserController:addUserPhoto");
});

$app->post("/login", "LoginController:Login");
$app->get("/profiles", "ProfileController:fetchProfile");
$app->put("/swipe", "SwipeController:swipeProfile");
