<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});
$class = $_GET['class'] ?? '\lib\cars';
$methode = $_GET['methode'] ?? '';
$parameter = $_GET['parameter'] ?? '';
try {
    $app = new $class($methode, $parameter);
} catch(Exception $e) {
    echo $e->getMessage();
}