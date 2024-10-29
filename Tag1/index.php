<?php
// Funktion zur Überprüfung, ob eine Zahl eine Primzahl ist
function isPrime($num) {
    if ($num <= 1) return false; // 0 und 1 sind keine Primzahlen
    if ($num == 2) return true; // 2 ist die einzige gerade Primzahl

    // Alle Zahlen größer als 2, die durch eine kleinere Zahl teilbar sind, sind keine Primzahlen
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;                 
        }
    }
    return true;
}

// Durchlaufe alle Zahlen von 0 bis 255
for ($i = 0; $i <= 255; $i++) {
    if ($i == 0 || $i == 1) {
        echo "$i = weder Primzahl noch gerade/ungerade\n";
    } elseif ($i % 2 == 0) {
        // Wenn die Zahl durch 2 teilbar ist, ist sie gerade
        echo "$i = gerade\n";
    } elseif (isPrime($i)) {
        // Wenn die Zahl eine Primzahl ist
        echo "$i = Primzahl\n";
    } else {
        // Wenn die Zahl weder gerade noch Primzahl ist, ist sie ungerade
        echo "$i = ungerade\n";
    }
}
?>
