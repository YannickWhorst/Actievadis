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
   <div class="page">
    <div class="imageClass">
        <img src="img/uploads/<?php echo $row["activiteit_afbeelding"] ?>" class="img"/>
    </div>
    <div class="text">
        <h1 class="Titel"><?php echo $row["activiteit_naam"] ?></h1>
        <div class="tekst">Locatie: <?php echo $row["activiteit_locatie"] ?></div>
        <div class="tekst">Inclusief eten:  
            <?php
                if($row["activiteit_eten"] == 1){
                    echo 'ja'; 
                } else{
                    echo 'nee';  
                }
            ?>
        </div>
        <div class="tekst">Minimaal aantal deelnemers: <?php echo $row["activiteit_min_deelnemers"] ?> (<?php echo $rowCount['COUNT(id)']; ?>) </div>
        <div class="tekst">Maximaal aantal deelnemers: <?php echo $row["activiteit_max_deelnemers"] ?></div> 
        <div class="tekst">Kosten: <?php echo '€' . $row["activiteit_kosten"] ?></div>
        <div class="tekst">Benodigheden: <?php echo $row["activiteit_benodigdheden"] ?></div>
        <div class="tekst">Omschrijving: <?php echo $row["activiteit_omschrijving"] ?></div>
        <div class="tekst">Datum: <?php echo $row["activiteit_datum"] ?></div>
        <div class="tekst">Van <?php echo date("H:i", strtotime($row["activiteit_begin_tijd"])) ?> tot <?php echo date("H:i", strtotime($row["activiteit_eindtijd"])) ?></div>
        <?php if ($isIngeschreven == null) { ?>
        <form action="inschrijven.php" method="post" >
            <input type="hidden" name="activiteit_id" value="<?php echo $id ?>" >
            <input type="submit" value="Inschrijven" class="buttonInschrijven">
        </form>
        <?php } else { ?>
            <div class="tekst fs-3">Je bent ingeschreven</div>
        <?php } ?>
    </div>  

</body>
</html>

<?php
    include "footer.php";
?>
