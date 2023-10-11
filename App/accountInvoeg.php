<?php
    include "header.php";

    if (isset($_POST['registreer']))  
    {
        $sql = "INSERT INTO covadiaan (covadiaan_email, covadiaan_naam, covadiaan_wachtwoord , covadiaan_rol_id)
        VALUES ('".$_POST["email"]."', '".$_POST["name"]."', '".$_POST["password"]."', '".$_POST["rolId"]."')";
        if(db_insertData($sql)) {
            header("Location: accountBeheer.php");
            exit();
        }
    }
?>

<div class="container w-50">
    <h1>Registreer personen</h1>
    <form method="post" action="">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" placeholder="naam@voorbeeld.com" required>
            <label for="email">Email address *</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" placeholder="naam" required>
            <label for="name">Name *</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" placeholder="wachtwoord" required>
            <label for="password">Wachtwoord *</label>
        </div>
        <div class="form-floating">
            <select class="form-select" name="rolId" required>
                <option value="1" selected>Werknemer</option>
                <option value="2">Admin</option>
            </select>
            <label for="rolId">Rol</label>
        </div>
        <input type="submit" class="btn btn-primary mt-3" name="registreer" value="Registreer">
    </form>
</div>


<?php
    include "footer.php";
?>
