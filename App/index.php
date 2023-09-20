<?php
    include "header.php";

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
            $_SESSION['rol_id'] = $covidaan['covadiaan_rol_id'];
            header("Location: activiteiten.php");
        } 
    }
?>

<head>
    <link rel="stylesheet" href="css/index.css">
</head>

<div class="container d-flex justify-content-center">
    <form method="POST" action="" class="card text-center w-50 d-flex align-items-center">
        <h2>Login</h2>
        <div class="form-floating mb-3 w-75">
            <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3 w-75">
            <input type="password" class="form-control" id="password" name="password" required placeholder="Wachtwoord">
            <label for="password">Wachtwoord</label>
        </div>
        <button type="submit" name="inloggen" class="inlog-btn mb-3 w-25">Submit</button>
    </form>

</div>

<?php
    include "footer.php";
?>
