<?php

include "header.php";

$sql = "SELECT * FROM activiteit WHERE `id` = " . $_POST['id'];
$activiteiten = db_getData($sql);
$row = $activiteiten->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['bewerken'])) {
    // Haal de ingevulde gegevens op uit het formulier
    $id = $_POST['id'];
    $naam = $_POST["naam"];
    $locatie = $_POST["locatie"];
    $eten = isset($_POST['eten']) ? 1 : 0;
    $minDeelnemers = $_POST["minDeelnemers"];
    $maxDeelnemers = $_POST["maxDeelnemers"];
    $kosten = $_POST["kosten"];
    $benodigdheden = $_POST["benodigdheden"];
    $omschrijving = $_POST["omschrijving"];
    $datum = $_POST["activiteit_datum"];
    $startTijd = $_POST["activiteit_begin_tijd"];
    $eindTijd = $_POST["activiteit_eindtijd"];

    // Voer de update uit
    if (db_updateActiviteit($id, $naam, $locatie, $eten, $minDeelnemers, $maxDeelnemers, $kosten, $benodigdheden, $omschrijving, $datum, $startTijd, $eindTijd)) {
        // De gegevens zijn succesvol bijgewerkt, stuur de gebruiker door naar een andere pagina (bijvoorbeeld activiteitenBeheer.php)
        header("Location: activiteiten.php");
        exit();
    } else {
        // Er is een fout opgetreden bij het bijwerken van de gegevens, hier kun je verdere acties ondernemen of een foutmelding weergeven
        echo "Fout bij het bijwerken van de gegevens.";
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
        <h1>Update activiteit </h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="naam" name="naam" placeholder="Naam" value="<?php echo $row['activiteit_naam']; ?>">
                <label for="naam">Naam</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="locatie" name="locatie" placeholder="Locatie" value="<?php echo $row['activiteit_locatie']; ?>">
                <label for="locatie">Locatie</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="eten" name="eten" <?php echo $row['activiteit_eten'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="eten">Eten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="minDeelnemers" name="minDeelnemers" placeholder="1" value="<?php echo $row['activiteit_min_deelnemers']; ?>">
                <label for="minDeelnemers">Minimale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="maxDeelnemers" name="maxDeelnemers" placeholder="1" value="<?php echo $row['activiteit_max_deelnemers']; ?>">
                <label for="maxDeelnemers">Maximale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kosten" name="kosten" placeholder="Kosten" value="<?php echo $row['activiteit_kosten']; ?>">
                <label for="kosten">Kosten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="benodigdheden" name="benodigdheden" placeholder="Benodigdheden" value="<?php echo $row['activiteit_benodigdheden']; ?>">
                <label for="benodigdheden">Benodigdheden</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="omschrijving" name="omschrijving" placeholder="Omschrijving" value="<?php echo $row['activiteit_omschrijving']; ?>">
                <label for="omschrijving">Omschrijving</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="activiteit_datum" name="activiteit_datum" placeholder="datum" value="<?php echo date("Y-m-d", strtotime($row['activiteit_datum'])); ?>">
                <label for="activiteit_datum">Activiteit datum</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_begin_tijd" name="activiteit_begin_tijd" placeholder="activiteit beginTijd" value="<?php echo date("H:i", strtotime($row['activiteit_begin_tijd'])); ?>"> 
                <label for="activiteit_begin_tijd">Start Tijd</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_eindtijd" name="activiteit_eindtijd" placeholder="eindTijd" value="<?php echo date("H:i", strtotime($row['activiteit_eindtijd'])); ?>"> 
                <label for="activiteit_eindtijd">Eind Tijd</label>
            </div>
            <div class="mb-3">
                <label for="afbeelding" class="form-label"><b>Afbeelding</b></label>
                <input class="form-control" type="file" id="afbeelding" name="afbeelding">
            </div>
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="Submit" class="btn btn-primary mt-1" name="bewerken" value="Bewerken">
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