<?php
//macht das man alle parameter declariert haben muss
declare(strict_types= 1);

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Steampixel\Route;



/**
 *  Startseite - Zeigt die Willkommensnachricht
 * 
 * @return void
 */
Route::add('/', function (): void 
{
    echo 'Welcome to the fridge page';
}, ['get', 'post']);

/**
 * Informationsseite- Zeigt PHP_Informationen an
 * 
 *  @return void
 */    

 Route::add('/info', function (): void {
    phpinfo();
 }, ['get','post']);

/**
 *  Ip checken
 * 
 */

 Route::add('/checkIP', function (): void {
    
    $ip = $_SERVER['REMPTE_ADDR'];

    echo "ihre IP'-Addresse lautet $ip";
    $apiURL= "https://ip-api.io/json/" .$ip;
    $ch = curl_init($apiURL);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $apiResponse = curl_exec($ch);
    curl_close($ch);

    echo '<pre>';
    print_r("$apiResponse");
    echo '</pre>';

 }, ['get', 'post']);

 /**
  * Dynamische Klassenroute - Lädt 

  */