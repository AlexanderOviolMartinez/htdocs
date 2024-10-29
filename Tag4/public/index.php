<?php
declare(strict_types=1);


session_start();

require __DIR__ . '/../vendor/autoload.php';

use Steampixel\Route;

/**
 * Startseite - Zeigt die Willkommensnachricht.
 *
 * @return void
 */
Route::add('/', function (): void {
    echo 'Welcome Tag 4 :-)';
}, ['get', 'post']);

/**
 * Informationsseite - Zeigt PHP-Informationen an.
 *
 * @return void
 */
Route::add('/info', function (): void {
    phpinfo();
}, 'get');

Route::add('/checkIP', function (): void
{
    $ip = $_SERVER['REMOTE_ADDR'];
    

    echo "ihre Ip'-Adresse lautet: $ip";
    $apiURL = "https://ip-api.io/json/" .$ip;
    $ch = curl_init($apiURL);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $apiResponse = curl_exec($ch);
    curl_close($ch);

    echo '<pre>';
    print_r("$apiResponse");
    echo '</pre>';



}, 'get') ;






/**
 * Dynamische Klassenroute - Lädt eine Klasse aus dem `app`-Namespace.
 *
 * @param string $class Der Klassenname, der geladen werden soll.
 * @return void
 */
Route::add('/([a-zA-Z0-9]*)', function (string $class): void {
    $appClass = "app\\$class\\$class";
    if (class_exists($appClass)) {
        $app = new $appClass();
    } else {
        echo "Class $appClass not found";
    }
},  ['get', 'post']);

/**
 * Dynamische Klassen- und Methodenroute - Lädt eine Klasse und führt eine Methode aus.
 *
 * @param string $class  Der Klassenname, der geladen werden soll.
 * @param string $methode Die Methode, die ausgeführt werden soll.
 * @return void
 */
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function (string $class, string $methode): void {
    $appClass = "app\\$class\\$class";
    if (class_exists($appClass)) {
        $app = new $appClass($methode);
    } else {
        echo "Class $appClass not found";
    }
}, ['get', 'post']);

/**
 * Dynamische Klassen-, Methoden- und Parameterroute - Lädt eine Klasse, führt eine Methode aus und übergibt einen Parameter.
 *
 * @param string $class     Der Klassenname, der geladen werden soll.
 * @param string $methode   Die Methode, die ausgeführt werden soll.
 * @param string $parameter Der Parameter, der der Methode übergeben werden soll.
 * @return void
 */
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function (string $class, string $methode, string $parameter): void {
    $appClass = "app\\$class\\$class";
    if (class_exists($appClass)) {
        $app = new $appClass($methode, $parameter);
    } else {
        echo "Class $appClass not found";
    }
}, ['get', 'post']);


/**
 * Fehlermeldung bei nicht gefundenen Routen.
 *
 * @return void
 */
Route::pathNotFound(function (): void {
    echo 'Error 404 :-(<br>';
});

// Führe den Router aus
Route::run('/');
