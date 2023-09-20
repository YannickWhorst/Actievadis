<?php
include "header.php";
include "./config/database_functions.php";
include "./config/database_config.php";
?>
<head>
    <link href="css/accountBeheer.css" rel="stylesheet" type="text/css">
</head>

<?php

if (isset($_POST['registreer']))  
{
 
 $sql = "INSERT INTO covadiaan (covadiaan_email, covadiaan_naam, covadiaan_wachtwoord , covadiaan_rol_id)
 VALUES ('".$_POST["email"]."', '".$_POST["name"]."', '".$_POST["password"]."', '".$_POST["rolId"]."')";
 $stmt = db_insertData($sql);

}
$sql = "SELECT * FROM covadiaan";
$accounts = db_getData($sql)
?>

<body>
    <div class="container registerContainer">
        <h1>Registreer personen</h1>
        <form method="post" action="">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="naam@voorbeeld.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="naam">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="wachtwoord">
                <label for="password">Wachtwoord</label>
            </div>
            <div class="form-floating">
                <select class="form-select" name="rolId">
                  <option value="1" selected>Werknemer</option>
                  <option value="2">Admin</option>
                </select>
                <label for="rolId">Rol</label>
            </div>
            <input type="submit" class="btn btn-primary mt-3" name="registreer" value="Registreer">
        </form>

        <h1>Personen (Accounts)</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Naam</th>
                <th scope="col">Email</th>
                <th scope="col">Wachtwoord</th>
                <th scope="col">Rol</th>
                <th scope="col">Acties</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while ($row = $accounts->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr class="align-middle">
                
                <td><?php echo $row['covadiaan_naam']; ?></td>
                <td><?php echo $row['covadiaan_email']; ?></td>
                <td><?php echo $row['covadiaan_wachtwoord']; ?></td>
                <td><?php echo $row['covadiaan_rol_id']; ?></td>
                <td class="d-flex gap-3">

                <form method="post" action="accountBewerk.php"> 
                  <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">    
                  <button type="submit" name="bewerk" class="btn btn-warning">Bewerk</button>
                </form>
                <form method="post" action=""> 
                  <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">    
                  <button type="submit" name="verwijder" class="btn btn-danger">Verwijder</button>
                </form>
                </td>
                
              </tr>
            <?php 
            }
            ?>
            </tbody>
          </table>
    </div>
</body>

<?php


if (isset($_POST['verwijder'])) {
  $id = $_POST['id'];
  if (db_deleteData($id)) {
      // Als de verwijdering succesvol is, toon dan een JavaScript pop-upmelding en vernieuw de pagina
      echo '<script>alert("Account is succesvol verwijderd."); window.location.href = window.location.href;</script>';
  } else {
      // Als er een fout optreedt, toon dan een JavaScript pop-upmelding met de foutmelding en vernieuw de pagina
      echo '<script>alert("Fout bij het verwijderen van het account: ' . $conn->error . '"); window.location.href = window.location.href;</script>';
  }
}

?>
<?php
include "footer.php";
?>