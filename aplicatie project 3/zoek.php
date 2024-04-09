<?php
include 'connection.php';

$zoekterm = $_GET['zoekterm'];

$zoekterm = mysqli_real_escape_string($conn, $zoekterm);

$sql = "SELECT * FROM producten WHERE artikelnummer LIKE '%$zoekterm%'";

$resultaat = $conn->query($sql);

if ($resultaat->num_rows > 0) {
    while($row = $resultaat->fetch_assoc()) {
        echo "ID: " . $row["artikelnummer"]. " - Naam: " . $row["omschrijving"]. "<br>";
    }
} else {
    echo "Geen resultaten gevonden";
}
$conn->close();
?>
