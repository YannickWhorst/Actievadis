<?php
include "header.php";


if (isset($_SESSION['covadiaan'])) {
    header("Location: activiteiten.php");
    exit();
}

if (isset($_POST['inloggen']))  {
    $email = $_POST['covadiaan_email'];
    $password = $_POST['covadiaan_wachtwoord'];
    $result = db_getData("SELECT * FROM covadiaan WHERE email = '$email' AND password = '$password'"); 
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>

<body>
    <div>
        <form method="POST" action="#">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" name="inloggen" value="inloggen"></input>
        </form>
    </div>
</body>

</html>

