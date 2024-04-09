<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");
?>

<?php 
    session_start(); 
    if (isset($_SESSION['user'])) { 
        $_SESSION = array(); 

        session_destroy(); 
    } 
     
    header("Location: index1.php"); 
    exit(); 
    ?> 
    <?php
include("./footer.php");
?>