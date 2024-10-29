<?php
namespace VehicleNamespace; // Define a namespace for the Vehicle classes

// Define the abstract class Vehicle
abstract class Vehicle {
    public $make;
    public $model;
    public $year;
    public $fuel;
    public $price;

    // Constructor to initialize vehicle objects
    public function __construct($make, $model, $year, $fuel, $price) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->price = $price;
    }

    // Abstract method that child classes must implement
    abstract public function displayVehicleInfo();
}

// Define the Driveable interface
interface Driveable {
    public function getMaxSpeed();
}
?>
