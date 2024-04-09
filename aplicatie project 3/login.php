<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1) {
            header("Location: kassa.php");
            exit();
        }
        else {
            $sql = "SELECT * FROM beheerders WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1) {
                header("Location: kassa_meer.php");
                exit();
            }
            else {
                echo '<script>
                alert("Login failed. Invalid username or password");
                window.location.href = "index1.php";
                </script>';
                exit();
            }
        }
    }
?>
