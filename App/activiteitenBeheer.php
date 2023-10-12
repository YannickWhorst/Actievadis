<?php
include "header.php";

$sql = "SELECT * FROM activiteit";
$activiteiten = db_getData($sql);
?>

<head>
    <link href="css/activiteitenBewerk.css" type="text/css" rel="stylesheet">
</head>

<div class="container">
    <h1>Activiteiten</h1>
    <form method="post" action="activiteitenInvoeg.php">
        <input type="submit" class="create" value="Activiteit aanmaken">
    </form>
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
                <th scope="col">Bekijks</th>
                <th scope="col">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $activiteiten->fetch(PDO::FETCH_ASSOC)) { 
                $id = $row['id'];
                $visits = db_getData("
                SELECT  id, SUM(aantal) as 'visits'
                FROM    visites
                WHERE `activiteit_id` = $id
                GROUP   BY activiteit_id")->fetch(PDO::FETCH_ASSOC);
                ?>
                <tr class="align-middle">
                    <td><?php echo $row['activiteit_naam']; ?></td>
                    <td><?php echo $row['activiteit_locatie']; ?></td>
                    <td><?php echo $row['activiteit_eten'] ? 'Ja' : 'Nee'; ?></td>
                    <td><?php echo $row['activiteit_min_deelnemers'] . '-' . $row['activiteit_max_deelnemers']; ?></td>
                    <td><?php echo $row['activiteit_kosten']; ?></td>
                    <td><?php echo $row['activiteit_benodigdheden']; ?></td>
                    <td><?php echo $row['activiteit_omschrijving']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['activiteit_datum'])) . ' ' . date("H:i", strtotime($row["activiteit_begin_tijd"])) . ' tot ' . date("H:i", strtotime($row["activiteit_begin_tijd"])); ?></td>
                    <td><?php echo $visits != null ? $visits['visits'] : 0; ?></td>
                    <td class="bg-white">
                        <form method="post" action="activiteitenBewerk.php">
                            <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">
                            <button type="submit" name="bewerk" class="btn btn-warning w-100">Bewerk</button>
                        </form>
                        <form name="deleteForm" method="post" action="" onsubmit="confirmDelete()">
                            <input type="hidden" id="id" name="id" value="<?php echo $row['id'] ?>">
                            <input type="submit" name="verwijder" class="btn btn-danger w-100" value="Verwijder">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
    if (isset($_POST['verwijder'])) {
        $id = $_POST['id'];
        if (db_deleteData($id, "activiteit")) {
            db_deleteInschrijvingen($id);
            // Als de verwijdering succesvol is, toon dan een JavaScript pop-upmelding en vernieuw de pagina
            echo '<script>alert("Activiteit is succesvol verwijderd."); window.location.href = window.location.href;</script>';
        } else {
            // Als er een fout optreedt, toon dan een JavaScript pop-upmelding met de foutmelding en vernieuw de pagina
            echo '<script>alert("Fout bij het verwijderen van het activiteitt: ' . $conn->error . '"); window.location.href = window.location.href;</script>';
        }
    }

    include "footer.php";
?>

<script>
    function confirmDelete() {
        return confirm("Weet je zeker dat je deze activiteit wil verwijderen?");
    }
</script>