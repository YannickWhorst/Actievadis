<?php
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
    $sql = "SELECT id, activiteit_afbeelding, activiteit_naam, activiteit_omschrijving FROM activiteit";
    $stmt = db_getData($sql);
?>

<div class="Product-main">    
    <?php
        // De resultaten weergeven in de HTML
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="ProductCard">
                <a class="card">  
                <div class="ImageProduct">
                        <img src="img/uploads/<?php echo $row["activiteit_afbeelding"] ?>" class="ImgCard"/>
                    </div>
                    <div class="TxtCard">
                        <?php echo $row["activiteit_naam"] ?>
                    </div>
                    <div class="TxtCard">
                        <?php echo $row["activiteit_omschrijving"] ?>
                    </div>
                    <form action="activiteitenExtraInfo.php" method="post" >
                        <input type="hidden" name="id" value="<?php echo $row["id"] ?>" >
                         <input type="submit" value="Lees meer" class="buttonactiviteit">
                    </form>
                    
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
