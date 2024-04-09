<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");

session_start();
echo "<div class='teksten'>" . $_SESSION['omschrijving'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_SESSION['prijs'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_SESSION['aantal'] . "<br>" . "</div>";
?>

<?php
include("./footer.php");
?>