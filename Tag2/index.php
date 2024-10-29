<?php
require_once 'Car.php'; // Include the Car class

use VehicleNamespace\Car; // Use the Car class from the VehicleNamespace

// Create the first Car object (Toyota Corolla)
$car1 = new Car('Toyota', 'Corolla', 2020, 180, 50, 20000);

// Create the second Car object (Hyundai Grandeur Saloon)
$car2 = new Car('Hyundai', 'Grandeur Saloon', 2023, 220, 65, 35000);

// Display the details of the first car
echo nl2br($car1->displayVehicleInfo() . "\n\n");

// Display the details of the second car
echo nl2br($car2->displayVehicleInfo() . "\n");
?>
