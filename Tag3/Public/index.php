<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

// Use this namespace
use Steampixel\Route;

Route::add("/", function () {
    echo "welcome :-)";
}, ['get', 'post']);

// Route für das Abrufen von Daten ohne Parameter
Route::add('/([a-zA-Z0-9]*)', function($class) {
    $appclass = "app\\$class\\$class";
    
    if (class_exists($appclass)) {
        echo "Hello $class ";
        $app = new $appclass;
    } else {
        echo "Error: 404 (Class $class not found)";
    }
}, 'get');

// Route für das Abrufen von Daten mit einer Methode
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode) {
    $appclass = "app\\$class\\$class";
    
    if (class_exists($appclass)) {
        echo "Hello $class <br>";
        $app = new $appclass($methode);
    } else {
        echo "Error: 404 (Class $class not found)";
    }
}, 'get');

// Route für das Abrufen von Daten mit einer Methode und einem Parameter
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function($class, $methode, $parameter) {
    $appclass = "app\\$class\\$class";
    
    if (class_exists($appclass)) {
        echo "Hello $class <br>";
        $app = new $appclass($methode, $parameter);
    } else {
        echo "Error: 404 (Class $class not found)";
    }
}, 'get');

// 404-Fehlerbehandlung
Route::pathNotFound(function() {
    echo "404 error";
});

// Router starten
Route::run('/');
