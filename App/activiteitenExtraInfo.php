<?php
include "header.php";
include "./config/database_functions.php";
include "./config/database_config.php";
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
    $id = $_POST["id"];
    $sql = "SELECT * FROM activiteit WHERE id = $id";
    $stmt = db_getData($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
   <div class="page">
    <img src="img/uploads/<?php echo $row["activiteit_afbeelding"] ?>" class="img"/>
    <div class="text">
        <h1 class="Titel"><?php echo $row["activiteit_naam"] ?></h1>
        <div class="tekst">Locatie: <?php echo $row["activiteit_locatie"] ?></div>
        <div class="tekst">Inclusief eten:  
        <?php
        if($row["activiteit_eten"] = 1){
             echo 'ja'; 
        } else{
            echo 'nee';  
        }
         ?></div>
        <div class="tekst">Maximaal aantal deelnemers: <?php echo $row["activiteit_max_deelnemers"] ?></div>
        <div class="tekst">Minimaal aantal deelnemers: <?php echo $row["activiteit_min_deelnemers"] ?></div>
        <div class="tekst">Kosten: <?php echo $row["activiteit_kosten"] ?></div>
        <div class="tekst">Benodigheden: <?php echo $row["activiteit_benodigdheden"] ?></div>
        <div class="tekst">Omschrijving: <?php echo $row["activiteit_omschrijving"] ?></div>
        <div class="tekst">Begin tijd: <?php echo $row["activiteit_begin_tijd"] ?></div>
        <div class="tekst">Eind tijd: <?php echo $row["activiteit_eindtijd"] ?></div>
    </div>
    </div>
</body>
</html>
<?php
include "footer.php";
?>