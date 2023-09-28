<?php
    include "header.php";

    if (isset($_SESSION['covadiaan']) || isset($_SESSION['guest'])) {
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

    if (isset($_POST['guest'])) {
        $naam = $_POST['name'];
        $_SESSION['guest'] = $naam;
        header("Location: activiteiten.php");
    }
?>

<head>
    <link rel="stylesheet" href="css/index.css">
</head>

<div class="container d-flex justify-content-center flex-column mt-8">
    <form method="POST" action="" class="card text-center w-50 d-flex align-items-center mt-4">
        <h2>Login</h2>
        <div class="form-floating mb-3 w-75">
            <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3 w-75">
            <input type="password" class="form-control" id="password" name="password" required placeholder="Wachtwoord">
            <label for="password">Wachtwoord</label>
        </div>
        <button type="submit" name="inloggen" class="inlog-btn mb-3 w-25">Inloggen</button>
    </form>
    <form method="POST" action="" class="card text-center w-50 d-flex align-items-center mt-4">
        <h2>Inloggen als gast</h2>
        <div class="form-floating mb-3 w-75">
            <input type="name" class="form-control" id="name" name="name" required placeholder="naam">
            <label for="name">Naam</label>
        </div>
        <button type="submit" name="guest" class="inlog-btn mb-3 w-25">Inloggen</button>
    </form>
</div>

<?php
    include "footer.php";
?>
