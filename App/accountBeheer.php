<?php
  include "header.php";
?>

<head>
    <link href="css/accountBeheer.css" rel="stylesheet" type="text/css">
</head>

<?php
  $sql = "SELECT * FROM covadiaan";
  $accounts = db_getData($sql);
?>

<body>
    <div class="container w-75">
        <h1>Personen (Accounts)</h1>
        <form action="accountInvoeg.php">
          <input type="submit" class="buttonInschrijven" value="Account aanmaken">
        </form>
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
                <td class="<?php echo $row['id'] != $_SESSION['covadiaan_id'] ? 'd-flex gap-3' : ''; ?>">

                <?php if ($row['id'] != $_SESSION['covadiaan_id']) { ?>
                <form method="post" action="accountBewerk.php"> 
                  <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">    
                  <button type="submit" name="bewerk" class="btn btn-warning">Bewerk</button>
                </form>

                <form method="post" action=""> 
                  <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">    
                  <button type="submit" name="verwijder" class="btn btn-danger">Verwijder</button>
                </form>
                <?php } ?>
                
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
  if (db_deleteData($id, "covadiaan")) {
      // Als de verwijdering succesvol is, toon dan een JavaScript pop-upmelding en vernieuw de pagina
      echo '<script>alert("Account is succesvol verwijderd."); window.location.href = window.location.href;</script>';
  } else {
      // Als er een fout optreedt, toon dan een JavaScript pop-upmelding met de foutmelding en vernieuw de pagina
      echo '<script>alert("Fout bij het verwijderen van het account: ' . $conn->error . '"); window.location.href = window.location.href;</script>';
  }
}

  include "footer.php";
?>