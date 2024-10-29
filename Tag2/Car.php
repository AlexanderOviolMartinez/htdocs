<?php
namespace VehicleNamespace; // Ensure this matches the namespace in Vehicle.php

require_once 'Vehicle.php'; // Include the Vehicle class and Driveable interface

// The Car class extends Vehicle and implements Driveable
class Car extends Vehicle implements Driveable {
    public $speed;

    // Constructor to initialize Car objects
    public function __construct($make, $model, $year, $speed, $fuel, $price) {
        // Call the parent constructor from Vehicle class
        parent::__construct($make, $model, $year, $fuel, $price);
        $this->speed = $speed;
    }

    // Implement the getMaxSpeed method from the Driveable interface
    public function getMaxSpeed() {
        return $this->speed;
    }

    // Implement the displayVehicleInfo method from the Vehicle abstract class
    public function displayVehicleInfo() {
        return "Car: $this->year $this->make $this->model\n" .
               "Speed: " . $this->getMaxSpeed() . " km/h\n" .
               "Fuel: $this->fuel L\n" .
               "Price: \$$this->price";
    }
}
?>
