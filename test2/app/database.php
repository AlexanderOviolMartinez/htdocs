<?php

//http://localhost/test2/index.php?class=\app\database&methode=df&parameter=hallo

namespace app;
use PDO;
class database {
    function __construct($methode, $parameter){
        echo "database - Klasse geladen";
        if(method_exists($this, $methode)) {
            $this->$methode($parameter);
        } else {
            echo "Methode nicht gefunden";
            \lib\response::error(404);
        }
    }
 
    function getData($parameter) {
        /* echo "getData wird geladen";
        echo "Parameter: $parameter<br>"; */
 
        try {
            // Erstellen Sie eine neue Datenbankverbindung mit PDO (Klasse)
            $pdo = new PDO('mysql:host=localhost;dbname=m295', 'root', '');
            // Setzen Sie das Error-Handling auf Exceptions
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // SQL-Abfrage vorbereiten und ausführen
            $sql = "SELECT * FROM cars";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            // Ergebnisse holen
            $cars = $statement->fetchAll(PDO::FETCH_ASSOC);
            // Array ausgeben zur Kontrolle
            echo "<pre>";
            print_r($cars);
            echo "</pre>";
        } catch (\PDOException $e) {
            // Fehlerbehandlung, wenn eine PDOException auftritt
            echo "Datenbankfehler: " . $e->getMessage();
            die();
        } catch (\Exception $e) {
            // Fehlerbehandlung für andere mögliche Exceptions
            echo "Allgemeiner Fehler: " . $e->getMessage();
            die();
        }
    }
}