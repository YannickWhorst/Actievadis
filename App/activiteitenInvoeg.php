<?php
include "header.php";

if(isset($_POST['voeg'])) {
    // Controleer of er een bestand is geüpload
    if(isset($_FILES["afbeelding"]) && is_uploaded_file($_FILES["afbeelding"]["tmp_name"])) {
        $afbeelding_naam = $_FILES["afbeelding"]["name"];
        
        // Verwerk de overige formuliervelden
        $naam = $_POST["naam"];
        $locatie = $_POST["locatie"];
        $eten = isset($_POST['eten']) ? 1 : 0;
        $minDeelnemers = $_POST["minDeelnemers"];
        $maxDeelnemers = $_POST["maxDeelnemers"];
        $kosten = $_POST["kosten"];
        $benodigdheden = $_POST["benodigdheden"];
        $omschrijving = $_POST["omschrijving"];
        $Datum = $_POST["activiteit_datum"];
        $startTijd = $_POST["activiteit_begin_tijd"];
        $eindTijd = $_POST["activiteit_eindtijd"];
        
        if($minDeelnemers > $maxDeelnemers)
        {
         ?> <h4 style="text-align: center; margin-top: 250px;">Maximale deelnemers is kleiner dan minimale deelnemers, <a href="activiteitenInvoeg.php">probeer opnieuw</a>!</div><?php
            exit;
        }
        
        // Voeg de gegevens toe aan de database
        $sql = "INSERT INTO `activiteit`(`activiteit_naam`, `activiteit_locatie`, `activiteit_eten`, `activiteit_max_deelnemers`, `activiteit_min_deelnemers`, `activiteit_kosten`, `activiteit_benodigdheden`, `activiteit_omschrijving`, `activiteit_datum`, `activiteit_begin_tijd`, `activiteit_eindtijd`, `activiteit_afbeelding`) 
        VALUES ('$naam', '$locatie', $eten, $maxDeelnemers, $minDeelnemers, '$kosten', '$benodigdheden', '$omschrijving', '$Datum' , '$startTijd' , '$eindTijd', '$afbeelding_naam')";
        
        // Voer de SQL-query uit om de gegevens in de database in te voegen.
        $stmt = db_insertData($sql);
    
    } 
}
?>

<head>
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link href="css/activiteitenBewerk.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container registerContainer">
    <form method="post" action="activiteitenBeheer.php">
        <input type="submit" class="create mt-4" value="Terug">
    </form>
        <h1>Voeg activiteit toe</h1>
        <form method="post" action="#" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="naam" name="naam" placeholder="Naam" required>
                <label for="naam">Naam *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="locatie" name="locatie" placeholder="Locatie" required>
                <label for="locatie">Locatie *</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="eten" name="eten">
                <label class="form-check-label" for="eten">Eten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="maxDeelnemers" name="maxDeelnemers" placeholder="1" required>
                <label for="maxDeelnemers">Maximale deelnemers *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="minDeelnemers" name="minDeelnemers" placeholder="1" required>
                <label for="minDeelnemers">Minimale deelnemers *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kosten" name="kosten" placeholder="Kosten" required>
                <label for="kosten">Kosten *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="benodigdheden" name="benodigdheden" placeholder="Benodigdheden">
                <label for="benodigdheden">Benodigdheden</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="omschrijving" name="omschrijving" placeholder="Omschrijving" required>
                <label for="omschrijving">Omschrijving *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="activiteit_datum" name="activiteit_datum" placeholder="datum" required>
                <label for="activiteit_datum">activiteit datum *</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_begin_tijd" name="activiteit_begin_tijd" placeholder="activiteit beginTijd" required> 
                <label for="activiteit_begin_tijd">startTijd *</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_eindtijd" name="activiteit_eindtijd" placeholder="eindTijd" required> 
                <label for="activiteit_eindtijd">eindTijd *</label>
            </div>
            <div class="mb-3">
                <label for="afbeelding" class="form-label"><b>Afbeelding *</b></label>
                <input class="form-control" type="file" id="afbeelding" name="afbeelding" required >
            </div>
            <input type="Submit" class="btn btn-primary mt-1 mb-3" name="voeg" value="Voeg toe">
        </form>

        
</body>

<?php
if(isset($_FILES['afbeelding'])){
    $file_name = $_FILES['afbeelding']['name'];     // De oorspronkelijke bestandsnaam
    $file_tmp = $_FILES['afbeelding']['tmp_name'];   // De tijdelijke bestandsnaam op de server
    
    // Bepaal de doelmap en bestandsnaam op de doellocatie
    $target_directory = "img/uploads/";
    $target_file = $target_directory . $file_name;
    
    // Verplaats het bestand van de tijdelijke locatie naar de doelmap
    if(move_uploaded_file($file_tmp, $target_file)){
        // Bestand is succesvol verplaatst
        //echo "De afbeelding is succesvol geüpload naar de map 'images'.";
    } else {
        // Er is een probleem opgetreden bij het verplaatsen van het bestand
        //echo "Er is een probleem opgetreden bij het uploaden van de afbeelding.";
    }
}

?>

<?php
include "footer.php";
?>