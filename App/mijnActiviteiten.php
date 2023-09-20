<?php
include "header.php";
?>

<?php
    $sql = "SELECT activiteit_id, opmerking FROM inschrijving WHERE covadiaan_id = ".$_SESSION['covadiaan_id'];
    $inschrijvingen = db_getData($sql);
?>

<body>
    <div class="container detailsContainer text-start">
    <?php while ($row = $inschrijvingen->fetch(PDO::FETCH_ASSOC)) {
        $sql = "SELECT * FROM activiteit WHERE id = ".$row["activiteit_id"];
        $activiteit = db_getData($sql)->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="card mx-auto mb-4">
        <div class="imgDiv mx-auto">
            <img class="w-100 m-auto" src="img/uploads/<?php echo $activiteit['activiteit_afbeelding']; ?>"/>
        </div>
        <div class="card-body">
        <h5 class="card-title fs-2"><?php echo $activiteit["activiteit_naam"]; ?></h5>
        <div class="card-text">
            <p class="body rounded border p-2"><?php echo $activiteit["activiteit_omschrijving"]; ?></p>
            <h5>Locatie: <?php echo $activiteit["activiteit_locatie"]; ?></h5>
            <h5>Opmerking: <?php echo $row["inschrijving_opmerking"]; ?></h5>
            <small class="text-muted">Begint op: <?php echo $activiteit["activiteit_begin_tijd"]; ?></small><br>
            <small class="text-muted">Eindigt op: <?php echo $activiteit["activiteit_eindtijd"]; ?></small>
        </div>
        </div>
        <div class="card-footer d-flex justify-content-between detailButtons">
            <a href="/recepts/{{$recept->id}}/edit" class="btn btn-primary btn-block btn-warning">Uitschrijven</a>
        </div>
    </div>
    <?php } ?>
    </div>
</body>