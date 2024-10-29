<?php
namespace app\cars;

use Exception;
use Valitron\Validator;
use lib\response\Response;


/**
 * Class cars for managing car data.
 */
class cars {
    /**
     * Model class for DB access.
     * 
     * @var model $model
     */
    private model $model;

    /**
     * Constructor for the cars class.
     *
     * @param string $method   The method to be called.
     * @param string $parameter The parameter to be passed to the method.
     */
    public function __construct(string $method = "", string $parameter = "") {
        $this->model = new model();
        if (!empty($method) && method_exists($this, $method)) {
            try {
                $this->$method($parameter);
            } catch (Exception $e) {
                $this->respond("Error: " . $e->getMessage(), "error", "red");
            }
        } else {
            $this->init();
        }
    }

    /**
     * Fetches data from the database based on the ID.
     *
     * @param string|null $id The car ID (optional).
     * @return void
     */
    public function getData(?string $id): void {
        $sql = $id === null ? "SELECT * FROM cars" : "SELECT * FROM cars WHERE id = :id";
        $data = $id === null ? [] : ["id" => $id];
        
        try {
            $result = $this->model->getData($sql, $data);
            $this->respond($result, "success", "green");
        } catch (Exception $e) {
            $this->respond("Error fetching data: " . $e->getMessage(), "error", "red");
        }
    }

    /**
     * Inserts new data into the database.
     *
     * @return void
     */
    public function insertData(): void {
        if (empty($_POST)) {
            $this->respond("Error: No POST data found.", "error", "red");
            return;
        }

        $carData = $_POST;
        $v = new Validator($carData);
        $v->rule('required', 'name')->message('Name cannot be empty');
        $v->rule('regex', 'name', '/^[a-zA-Z0-9]+$/')->message('Only letters and numbers are allowed');
        $v->rule('lengthMin', 'name', 4)->message('Name must be at least 4 characters long');
        $v->rule('lengthMax', 'name', 30)->message('Name cannot exceed 30 characters');

        if (!$v->validate()) {
            $this->respond($v->errors(), "validation_error", "yellow");
            return;
        }

        $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang) 
                VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang)";

        try {
            $this->model->execute($sql, $carData);
            $this->respond("Entry added successfully.", "success", "green");
        } catch (Exception $e) {
            $this->respond("Error adding entry: " . $e->getMessage(), "error", "red");
        }
    }

    /**
     * Updates existing data in the database.
     *
     * @param int $carId The ID of the car to be updated.
     * @return void
     */
    public function updateData(int $carId): void {
        $carData = [
            "id" => $carId,
            "name" => "Skoda Superb",
            "price" => 36000
        ];

        $sql = "UPDATE cars SET name = :name, price = :price WHERE id = :id";

        try {
            $this->model->execute($sql, $carData);
            $this->respond("Entry updated successfully.", "success", "blue");
        } catch (Exception $e) {
            $this->respond("Error updating entry: " . $e->getMessage(), "error", "red");
        }
    }

    /**
     * Löscht Daten aus der Datenbank.
     *
     * @return void
     */
    public function deleteData(string $carId): void {
        
        if ($_SESSION['stufe'] == 1){
        $sql = "DELETE FROM cars WHERE id = :id";
        
        try {
            $this->model->execute($sql, ["id" => $carId]);
            echo "Eintrag erfolgreich gelöscht.";
        } catch (Exception $e) {
            echo "Fehler beim Löschen: " . $e->getMessage();
        }
    } else
    {
        response::errorJSON(array:["error"=>"keine Berechtigung"]);
    }

    }

    /**
     * Initializes the class.
     *
     * @return void
     */
    public function init(): void {
        $this->respond("Initialization complete.", "info", "gray");
    }

    /**
     * Unified response method for JSON output.
     *
     * @param mixed $message The message or data to output.
     * @param string $status The status of the response (e.g., 'success', 'error').
     * @param string $color  The color associated with the response type.
     * @return void
     */
    private function respond(mixed $message, string $status, string $color): void {
        header('Content-Type: application/json');
        echo json_encode([
            "status" => $status,
            "color" => $color,
            "message" => $message
        ]);
    }
}
