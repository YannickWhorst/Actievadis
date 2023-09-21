<?php
    include "header.php";

    $sql = "SELECT * FROM inschrijving";
    $stmt = db_getData($sql);

    function getNaam($id, $naam, $table) {
        $sql = "SELECT $naam FROM $table WHERE id = $id";

        $stmt = db_getData($sql);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row[$naam];
    }
?>

<head>
    <link rel="stylesheet" href="css/inschrijvingenOverzicht.css">
</head>

<div class="card mt-8 w-50 inschrijvingen container d-flex align-items-center flex-column">
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
            <td><?= getNaam($row['activiteit_id'], "activiteit_naam", "activiteit") ?></td>
            <td><?= getNaam($row['covadiaan_id'], "covadiaan_naam", "covadiaan") ?></td>
            <td><?= $row['inschrijving_opmerking'] == '' 
                    ? "<p><small><i>Geen opmerking</i></small></p>" 
                    : $row['inschrijving_opmerking'] ?>
            </td>
        </tr>
    <?php } ?>
        </tbody>
    </table>
</div>

<?php
    include "footer.php";
?>