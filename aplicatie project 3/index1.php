<?php
include("./header.php");
include("./pageheader.php");
include("connection.php");
?>
<header id="content">
<div id="form">
            <h2 class= "kop">Login Form</h2>
            <form name="form" action="login.php" method= "POST">
                <label class="naam">Username:</label>
                <input type="text" id="user" name="user"></br></br>
                <label class="naam">password</label>
                <input type="password" id="pass" name="pass"></br></br>
                <input type="submit" id="btn" value="login" name="submit"/>
            </form>
        </div> 
</header>        
<?php
include("./footer.php");
?>