<?php

namespace App\Service;

class RandomGeneratorService
{
    static function generateHashPassword($str): string
    {
        return password_hash($str, PASSWORD_DEFAULT);
    }

    static function getRandomName($gender): string
    {
        $haystack_men = ['Liam', 'Noah', 'Oliver', 'William', 'Elijah', 'James', 'Benjamin', 'Lucas', 'Mason', 'Ethan', 'Alexander', 'Henry', 'Jacob', 'Michael', 'Daniel', 'Logan', 'Jackson', 'Sebastian', 'Jack', 'Aiden', 'Owen', 'Samuel', 'Matthew', 'Joseph', 'Levi', 'Mateo', 'David', 'John', 'Wyatt', 'Carter', 'Julian', 'Luke', 'Grayson', 'Isaac', 'Jayden', 'Theodore', 'Gabriel', 'Anthony', 'Dylan', 'Leo', 'Lincoln', 'Jaxon', 'Asher', 'Christopher', 'Josiah', 'Andrew', 'Thomas', 'Joshua', 'Ezra', 'Hudson', 'Charles', 'Caleb', 'Isaiah', 'Ryan', 'Nathan', 'Adrian', 'Christian', 'Maverick', 'Colton', 'Elias', 'Aaron', 'Eli', 'Landon', 'Jonathan', 'Nolan', 'Hunter', 'Cameron', 'Connor', 'Santiago', 'Jeremiah', 'Ezekiel', 'Angel', 'Roman', 'Easton', 'Miles', 'Robert', 'Jameson', 'Nicholas', 'Greyson', 'Cooper', 'Ian', 'Carson', 'Axel', 'Jaxson', 'Dominic', 'Leonardo', 'Luca', 'Austin', 'Jordan', 'Adam', 'Xavier', 'Jose', 'Jace', 'Everett', 'Declan', 'Evan', 'Kayden', 'Parker', 'Wesley', 'Kai'];
        $haystack_women = ['Olivia', 'Emma', 'Ava', 'Sophia', 'Isabella', 'Charlotte', 'Amelia', 'Mia', 'Harper', 'Evelyn', 'Abigail', 'Emily', 'Ella', 'Elizabeth', 'Camila', 'Luna', 'Sofia', 'Avery', 'Mila', 'Aria', 'Scarlett', 'Penelope', 'Layla', 'Chloe', 'Victoria', 'Madison', 'Eleanor', 'Grace', 'Nora', 'Riley', 'Zoey', 'Hannah', 'Hazel', 'Lily', 'Ellie', 'Violet', 'Lillian', 'Zoe', 'Stella', 'Aurora', 'Natalie', 'Emilia', 'Everly', 'Leah', 'Aubrey', 'Willow', 'Addison', 'Lucy', 'Audrey', 'Bella', 'Nova', 'Brooklyn', 'Paisley', 'Savannah', 'Claire', 'Skylar', 'Isla', 'Genesis', 'Naomi', 'Elena', 'Caroline', 'Eliana', 'Anna', 'Maya', 'Valentina', 'Ruby', 'Kennedy', 'Ivy', 'Ariana', 'Aaliyah', 'Cora', 'Madelyn', 'Alice', 'Kinsley', 'Hailey', 'Gabriella', 'Allison', 'Gianna', 'Serenity', 'Samantha', 'Sarah', 'Autumn', 'Quinn', 'Eva', 'Piper', 'Sophie', 'Sadie', 'Delilah', 'Josephine', 'Nevaeh', 'Adeline', 'Arya', 'Emery', 'Lydia', 'Clara', 'Vivian', 'Madeline', 'Peyton', 'Julia', 'Rylee'];
        $needle = rand(0, 99);
        return ($gender === 'Male') ? $haystack_men[$needle] : $haystack_women[$needle];
    }

    static function getRandomLastName(): string
    {
        $haystack = ['Reid', 'Yu', 'Ochoa', 'Cantrell', 'Lucero', 'Hanna', 'Oliver', 'Bowers', 'Brandt', 'Clarke', 'Shelton', 'Stokes', 'Mcclure', 'Murray', 'Clay', 'Jenkins', 'Chase', 'Strickland', 'Pena', 'Koch', 'Price', 'Middleton', 'Walter', 'Wolf', 'Cruz', 'Lane', 'Hughes', 'Bridges', 'Walls', 'Dawson', 'Roberts', 'Smith', 'Holt', 'Diaz', 'Oneal', 'Krueger', 'Ortega', 'Santiago', 'Bush', 'Stark', 'Hamilton', 'Buck', 'Aguirre', 'Pennington', 'Bowen', 'Stout', 'Beck', 'Burch', 'Cobb', 'Underwood', 'Odom', 'Foster', 'Hayden', 'Castro', 'Tate', 'Potts', 'Peck', 'Dodson', 'Dunn', 'Choi', 'Osborn', 'Wheeler', 'Boyd', 'Beasley', 'Ruiz', 'Holden', 'Rhodes', 'Molina', 'Coleman', 'Glenn', 'Lynch', 'Livingston', 'Kane', 'Duncan', 'Bowman', 'Mendoza', 'Potter', 'Vang', 'Deleon', 'Evans', 'Macias', 'Arias', 'Joseph', 'Mills', 'Serrano', 'Barrett', 'Navarro', 'Banks', 'Decker', 'Joyce', 'Carpenter', 'Lin', 'Snyder', 'Jefferson', 'Leon', 'Prince', 'Cohen', 'Parrish', 'Perkins', 'Greer'];
        $needle = rand(0, 99);
        return $haystack[$needle];
    }

    static function getRandomPassword(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    static function getRandomAge(): int
    {
        return rand(18, 65);
    }

    static function getRandomGender(): string
    {
        $needle = rand(0, 1);
        return ($needle === 0) ? 'Male' : 'Female';
    }

    static function getRandomEmail($name, $lname): string
    {
        $name = strtolower(str_replace("'", "", $name));
        $lname = strtolower(str_replace("'", "", $lname));
        return $name . '.' . $lname . '@test.co.uk';
    }

    static function getLocation(): string
    {
        $needle = rand(0, 50);
        $haystack = ['Bath', 'Birmingham', 'Bradford', 'Brighton & Hove', 'Bristol', 'Cambridge', 'Canterbury', 'Carlisle', 'Chelmsford', 'Chester', 'Chichester', 'Coventry', 'Derby', 'Durham', 'Ely', 'Exeter', 'Gloucester', 'Hereford', 'Kingston-upon-Hull', 'Lancaster', 'Leeds', 'Leicester', 'Lichfield', 'Lincoln', 'Liverpool', 'London', 'Manchester', 'Newcastle-upon-Tyne', 'Norwich', 'Nottingham', 'Oxford', 'Peterborough', 'Plymouth', 'Portsmouth', 'Preston', 'Ripon', 'Salford', 'Salisbury', 'Sheffield', 'Southampton', 'St Albans', 'Stoke-on-Trent', 'Sunderland', 'Truro', 'Wakefield', 'Wells', 'Westminster', 'Winchester', 'Wolverhampton', 'Worcester', 'York'];
        return $haystack[$needle];
    }
}