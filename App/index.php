<?php
include "header.php";
include "./config/database_functions.php";
include "./config/database_config.php";

if (isset($_SESSION['covadiaan'])) {
    header("Location: activiteiten.php");
    exit();
}

if (isset($_POST['inloggen']))  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = db_getData("SELECT * FROM covadiaan WHERE covadiaan_email = '$email' AND covadiaan_wachtwoord = '$password'"); 

    $covidaan = $result->fetch(PDO::FETCH_ASSOC);
    if ($covidaan) {
        $_SESSION['covadiaan'] = $covidaan;
        $_SESSION['covadiaan_id'] = $covidaan['id'];
        header("Location: activiteiten.php");
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/inlog.css" type="text/css" rel="stylesheet">
        <title>Login</title>
    </head>

<body>
    <div class="displayvak";>
        <form class="inlogvak" method="POST" action="">
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

<?php
include "footer.php";
?>
