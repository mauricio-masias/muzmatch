#Muzmatch
Dating app test for Muzmatch

Deliverables:
- Part 1 - Basics
- Part 2 - Authentication
- Part 3 - Filtering
- Bonus - Profile photos

Running the app:
- git clone git@github.com:mauricio-masias/muzmatch.git (or unzip "solution_mauricio_masias.zip")
- composer install
- composer update
- docker-compose up -d
- server: http://localhost:8080/
- db credentials on .env

Postman:
- Import "postman-collection.json" located on the app root.

Description:
App with Docker containerization
- 2 containers:
- PHP: running PHP 7 (pdo and gd) and Apache
- DB: running Mariadb
- App develop on Slim framework
- Db Eloquent models
- Db data on: /docker/data (this should allow load the db data without having to import the db dump)
- Ff needed db dump is at: /docker/dump/dating_app.sql
- Dockerfile on: /docker/php7
- Image uploads are stored on: /uploads (chmod: 777)
- Receiving images using form-data 

Usage
- Requests:
    - /user/create
    - /profiles
    - /swipe
    - /login
    - /user/gallery
- Authorization required for all except /login and /user/create
- Bearer token expires after 1 hour
- To get token you need to /login ->this will give you a token
- Copy token into Authorization header after Bearer.

Tables:
- user
- profile
- pair (match is a reserved mysql word)
- gallery

Attractiveness:
- Scale min 1 - max 100;
- Each user starts with 50 value of attractiveness
- Each swipe (Yes) will add 1 to the user attractiveness  
- Each swipe (No) will rest 1 to the user attractiveness
- Yes and No are also stored on Profile table as likes and dislikes respectively

Matches:
- status 1 : means swipe a Yes
- status 0 : means swipe a No



