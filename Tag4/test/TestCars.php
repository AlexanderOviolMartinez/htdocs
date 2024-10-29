<?php
include "vendor/autoload.php";
use app\cars\cars;

class TestCars extends PHPUnit\Framework\TestCase{
    public function testCarClass(){
    $cars = new cars();
    $this->assertNotNull($cars);
    }
}