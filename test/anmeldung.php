<?php
// Wenn die Methode GET verwendet wurde:
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Benutzernamen und Passwort aus der GET-Anfrage auslesen
    if (isset($_GET['username']) && isset($_GET['password'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];
        echo "<h1>GET-Anfrage</h1>";
        echo "Benutzername: " . htmlspecialchars($username) . "<br>";
        echo "Passwort: " . htmlspecialchars($password) . "<br>";
    } else {
        echo "Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein (GET).";
    }
}

// Wenn die Methode POST verwendet wurde:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Benutzernamen und Passwort aus der POST-Anfrage auslesen
    if (isset($_POST['username_post']) && isset($_POST['password_post'])) {
        $username_post = $_POST['username_post'];
        $password_post = $_POST['password_post'];
        echo "<h1>POST-Anfrage</h1>";
        echo "Benutzername: " . htmlspecialchars($username_post) . "<br>";
        echo "Passwort: " . htmlspecialchars($password_post) . "<br>";
    } else {
        echo "Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein (POST).";
    }
}
?>
