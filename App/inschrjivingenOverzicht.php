<?php
    include "header.php";

    $sql = "SELECT * FROM inschrijving";
    $stmt = db_getData($sql);

    function getActiviteitNaam($activiteit_id) {
        $sql = "SELECT activiteit_naam FROM activiteit WHERE id = $activiteit_id";

        $stmt = db_getData($sql);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['activiteit_naam'];
    }

    function getCovadiaanNaam($covadiaan_id) {
        $sql = "SELECT covadiaan_naam FROM covadiaan WHERE id = $covadiaan_id";

        $stmt = db_getData($sql);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['covadiaan_naam'];
    }
?>

<head>
    <link rel="stylesheet" href="css/inschrijvingenOverzicht.css">
</head>

<div class="inschrijvingen container d-flex align-items-center flex-column">
    <h1>Inschrijvingen overzicht</h1>
    <table class="table table-hover table-striped w-50 text-center">
        <thead>
            <tr>
                <th>Activiteit</th>
                <th>Covadiaan</th>
                <th>Opmerking</th>
            </tr>
        <thead>
        <tbody>
    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= getActiviteitNaam($row['activiteit_id']) ?></td>
            <td><?= getCovadiaanNaam($row['covadiaan_id']) ?></td>
            <td><?= $row['inschrijving_opmerking'] ?></td>
        </tr>
    <?php } ?>
        </tbody>
    </table>
</div>


<?php
    include "footer.php";
?>