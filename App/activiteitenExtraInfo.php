<?php
    include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/actviteitenMeerInfo.css">
</head>
<body>
<?php
    $id = $_GET["id"];
    $sql = "SELECT * FROM activiteit WHERE id = $id";
    $deelnemerCount = "SELECT COUNT(id) FROM `inschrijving` WHERE `activiteit_id` = $id";
    $stmtCount = db_getData($deelnemerCount);
    $stmt = db_getData($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $covadiaanId = $_SESSION["covadiaan_id"];
    $isIngeschreven = db_getData("SELECT * FROM inschrijving WHERE `covadiaan_id` = $covadiaanId")->fetch(PDO::FETCH_ASSOC);
    $rowCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
?>
   <div class="page mt-5">
    <div class="imageClass">
        <img src="img/uploads/<?php echo $row["activiteit_afbeelding"] ?>" class="img"/>
    </div>
    <div class="text">
        <h1 class="Titel"><?php echo $row["activiteit_naam"] ?></h1>
        <div class="d-flex gap-5">
            <div>
                <p class="tekst"><b>Datum:</b> <?php echo date("d-m-Y", strtotime($row['activiteit_datum'])) ?></p>
                <p class="tekst"><b>Van</b> <?php echo date("H:i", strtotime($row["activiteit_begin_tijd"])) ?> <b>tot</b> <?php echo date("H:i", strtotime($row["activiteit_eindtijd"])) ?></p>
                <p class="tekst"><b>Locatie:</b> <?php echo $row["activiteit_locatie"] ?></p>
                <p class="tekst"><b>Inclusief eten:</b>  
                    <?php
                        if($row["activiteit_eten"] == 1){
                            echo 'ja'; 
                        } else{
                            echo 'nee';  
                        }
                    ?>
                </p>
            </div>
            <div>
                <p class="tekst"><b>Minimaal deelnemers:</b> <?php echo $row["activiteit_min_deelnemers"] ?> (<?php echo $rowCount['COUNT(id)']; ?>) </p>
                <p class="tekst"><b>Maximaal deelnemers:</b> <?php echo $row["activiteit_max_deelnemers"] ?></p> 
                <p class="tekst"><b>Kosten: €</b><?php echo $row["activiteit_kosten"] ?></p>
                <p class="tekst"><b>Benodigheden:</b> <?php echo $row["activiteit_benodigdheden"] ?></p>
            </div>
        </div>  
        <p class="tekst"><b>Omschrijving:</b> <?php echo $row["activiteit_omschrijving"] ?></p>
        <?php if ($isIngeschreven == null) { ?>
        <form action="inschrijven.php" method="post" >
            <input type="hidden" name="activiteit_id" value="<?php echo $id ?>" >
            <input type="submit" value="Inschrijven" class="buttonInschrijven">
        </form>
        <?php } else { ?>
            <p class="tekst fs-3">Je bent ingeschreven</p>
        <?php } ?>
    </div>  

</body>
</html>

<?php
    include "footer.php";
?>
