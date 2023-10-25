<?php
include "header.php";
?>

<?php
    $sql;
    if (isset($_SESSION['covadiaan'])) {
        $sql = "SELECT id, activiteit_id, inschrijving_opmerking FROM inschrijving WHERE covadiaan_id = ".$_SESSION['covadiaan_id'];
    } else {
        $sql = "SELECT id, activiteit_id, inschrijving_opmerking FROM inschrijving WHERE `gast_naam` = '".$_SESSION['guest'] . "'";
    }
    $inschrijvingen = db_getData($sql);
    if($inschrijvingen->fetch(PDO::FETCH_ASSOC) == '') {
        echo "<div class='container detailsContainer text-center'>
        <h1>Geen inschrijvingen</h1>
        <p>Graag inschrijven voor een <a href='activiteiten.php'>activiteit</a>.</p>
        </div>";
    } else {
        $inschrijvingen = db_getData($sql);
    }
?>

<body>
    <div class="container detailsContainer text-start mt-2">
    <?php while ($row = $inschrijvingen->fetch(PDO::FETCH_ASSOC)) {
        $sql = "SELECT * FROM activiteit WHERE id = ".$row["activiteit_id"];
        $activiteit = db_getData($sql)->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="card mx-auto w-75 mb-4">
            <div class="imgDiv mx-auto d-flex justify-content-center">
                <img class="w-50 m-auto" src="img/uploads/<?php echo $activiteit['activiteit_afbeelding']; ?>"/>
            </div>
            <div class="card-body">
            <h5 class="card-title fs-2"><?php echo $activiteit["activiteit_naam"]; ?></h5>
            <div class="card-text">
                <h5>Locatie: <?php echo $activiteit["activiteit_locatie"]; ?></h5>  
                <h5>Opmerking: <?php echo $row["inschrijving_opmerking"] == '' 
                                ? "<small><i>Geen opmerking</i></small>" 
                                : $row["inschrijving_opmerking"]; ?></h5>
                <p class="body rounded border p-2"><?php echo $activiteit["activiteit_omschrijving"]; ?></p>
                <small class="text-muted">Begint op: <?php echo date("H:i", strtotime($activiteit["activiteit_begin_tijd"])) ?></small><br>
                <small class="text-muted">Eindigt op: <?php echo date("H:i", strtotime($activiteit["activiteit_eindtijd"])) ?></small>
            </div>
            </div>
            <form class="card-footer d-flex justify-content-between detailButtons" method="post" action="#">
                <?php if(isset($_SESSION['covadiaan_id'])) {?>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['covadiaan_id']; 
                } else {?>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['guest']; 
                } ?>">
                <input type="hidden" name="activiteit_id" value="<?php echo $activiteit["id"]; ?>">
                <input class="btn btn-primary btn-block btn-warning" type="submit" name="uitschrijven" value="Uitschrijven">
            </form>
        </div>
    <?php } ?>
    </div>
</body>

<?php
    if(isset($_POST['uitschrijven'])) {
        if(isset($_SESSION["guest"])) {
            if(db_uitschrijvenGast($_POST["id"], $_POST["activiteit_id"])) {
                header("Location: mijnActiviteiten.php");
            }
        } else {
            if(db_uitschrijven($_POST["id"], $_POST["activiteit_id"])) {
                header("Location: mijnActiviteiten.php");
            }
        }
    }
    
    include "footer.php";
?>