<?php
include "header.php";

$sql = "SELECT * FROM activiteit";
$activiteiten = db_getData($sql)
?>

<h1>Activiteiten</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Locatie</th>
            <th scope="col">Eten</th>
            <th scope="col">Deelnemers</th>
            <th scope="col">Kosten</th>
            <th scope="col">Benodigdheden</th>
            <th scope="col">Omschrijving</th>
            <th scope="col">Datum</th>
            <th scope="col">Acties</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Hieronder veronderstel ik dat je een query hebt uitgevoerd om activiteitsgegevens op te halen
        while ($row = $activiteiten->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr class="align-middle">
                <td><?php echo $row['activiteit_naam']; ?></td>
                <td><?php echo $row['activiteit_locatie']; ?></td>
                <td><?php echo $row['activiteit_eten'] ? 'Ja' : 'Nee'; ?></td>
                <td><?php echo $row['activiteit_min_deelnemers'] . '-' . $row['activiteit_max_deelnemers']; ?></td>
                <td><?php echo $row['activiteit_kosten']; ?></td>
                <td><?php echo $row['activiteit_benodigdheden']; ?></td>
                <td><?php echo $row['activiteit_omschrijving']; ?></td>
                <td><?php echo $row['activiteit_datum'] . ' ' . $row['activiteit_begin_tijd'] . ' tot ' . $row['activiteit_eindtijd']; ?></td>
                <td class="d-flex gap-3">
                    
                    <form method="post" action="activiteitenBewerk.php">
                        <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">
                        <button type="submit" name="bewerk" class="btn btn-warning">Bewerk</button>
                    </form>
                    <form method="post" action="">
                        <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">
                        <button type="submit" name="verwijder" class="btn btn-danger">Verwijder</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

if (isset($_POST['verwijder'])) {
  $id = $_POST['id'];
  if (db_deleteData($id, "activiteit")) {
      // Als de verwijdering succesvol is, toon dan een JavaScript pop-upmelding en vernieuw de pagina
      echo '<script>alert("Activiteit is succesvol verwijderd."); window.location.href = window.location.href;</script>';
  } else {
      // Als er een fout optreedt, toon dan een JavaScript pop-upmelding met de foutmelding en vernieuw de pagina
      echo '<script>alert("Fout bij het verwijderen van het activiteitt: ' . $conn->error . '"); window.location.href = window.location.href;</script>';
  }
}


include "footer.php";
?>