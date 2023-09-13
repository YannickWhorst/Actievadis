<?php
    session_start();
    include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit</title>
    <link rel="stylesheet" href="css/activiteiten.css">
</head>
<body>


<?php
    $sql = "SELECT activiteit_afbeelding, activiteit_naam, activiteit_omschrijving FROM activiteit";
    $stmt = db_getData($sql);
?>

<div class="Product-main">    
    <?php
        // De resultaten weergeven in de HTML
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="ProductCard">
                <a class="card">
                    <div class="ImageProduct">
                        <img src="img/uploads/' . $row["activiteit_afbeelding"] . '" class="ImgCard"/>
                    </div>
                    <div class="TxtCard">
                        ' . $row["activiteit_naam"] . '
                    </div>
                    <div class="TxtCard">
                        ' . $row["activiteit_omschrijving"] . '
                    </div>
                </a>
            </div>';
    }
    ?>
</div>


