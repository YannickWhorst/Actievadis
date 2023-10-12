<?php
    include "header.php";

    if (!isset($_SESSION['covadiaan']) && !isset($_SESSION['guest'])) {
        header("Location: index.php");
        exit();
    }
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
    if (isset($_SESSION["ingeschreven"])) {
        unset($_SESSION["ingeschreven"]);
        echo "<script>alert('Succesvol ingeschreven!')</script>";
    }
    
    $sql = "SELECT id, activiteit_afbeelding, activiteit_naam, activiteit_locatie, activiteit_kosten, activiteit_datum 
            FROM activiteit 
            WHERE activiteit_datum > CURRENT_TIMESTAMP
            ORDER BY activiteit_datum";
    $stmt = db_getData($sql);
?>

<div class="Product-main">    
    <?php
        // De resultaten weergeven in de HTML
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="ProductCard">
                <a href="activiteitenExtraInfo.php?id=<?php echo $row['id'];?>" class="card">  
                    <div class="ImageProduct">
                        <img src="img/uploads/<?php echo $row["activiteit_afbeelding"] ?>" class="ImgCard"/>
                    </div>
                    <div class="TxtTitel">
                        <?php echo $row["activiteit_naam"] ?>
                    </div>
                    <div class="TxtCard">
                        <?php echo "Datum: &nbsp" . date("d-m-Y", strtotime($row['activiteit_datum'])) ?>
                    </div>
                    <div class="TxtCard">
                        <?php echo "Prijs: &nbsp€" . $row["activiteit_kosten"] ?>
                    </div>
                    <div class="TxtCard">
                        <?php echo "Locatie: &nbsp" . $row["activiteit_locatie"] ?>
                    </div>                    
                </a>
        </div>
   <?php }
    ?>
</div>
<?php
    include "footer.php";
?>
</body>
</html>
