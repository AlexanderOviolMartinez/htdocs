<?php

//include "./../lib/database.php";
//include "./../app/cars/model.php";
//include "./../app/cars/cars.php";
include "./../vendor/autoload.php";
//include "./../vendor/vlucas/Valitron/src/Valitron/Validator.php";


$green = "\033[32m";

$red = "\033[31m";

$yellow = "\033[33m";

$reset = "\033[0m";

echo "$yellow Testing Crud operations\n";
//instanz von cars erstellen
$cars = new app\cars\cars();

// insert
 $_POST = [
     "name" => "AA",
     "price" => 35000,
     "kraftstoff" => "Benzin",
     "farbe" => "#123456",
     "bauart" => "Limousine",
     "tank" => 0,
     "jahrgang" => "2023-01-01"
 ];

ob_start();
$cars->insertData(6);
$ausgabe = ob_get_clean();

echo $ausgabe;

echo (string) $reset;