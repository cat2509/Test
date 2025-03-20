<?php

session_start();
if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
        <body>
           <h1>Home</h1>
           
           <?php if (isset($_SESSION["user_id"])) : ?>
            <p>You are logged in.</p>
             <p><a href="logout.php">logOut</a></p>
           <?php else: ?>
            <p><a href="login.php">Login</a> or <a href ="signup.html">SignUp</a></p>
            <?php endif; ?>
        </body>
</html>