<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_aantal'])) {
    $artikelnummer = $_POST['artikelnummer'];
    $nieuw_aantal = $_POST['nieuw_aantal'];

    $update_query = "UPDATE producten SET aantal = $nieuw_aantal WHERE artikelnummer = $artikelnummer";
    
    if (mysqli_query($conn, $update_query)) {
        echo "Aantal succesvol bijgewerkt.";
    } else {
        echo "Fout bij bijwerken van aantal: " . mysqli_error($conn);
    }

    exit();
}
?>
