<?php

include "header.php";


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
        // header("Location: activiteiten.php");
        // exit();

        echo "test";
    } else {
        // Er is een fout opgetreden bij het bijwerken van de gegevens, hier kun je verdere acties ondernemen of een foutmelding weergeven
        echo "Fout bij het bijwerken van de gegevens.";
    }

}
?>

<head>
    <link href="css/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container registerContainer">
        <h1>Update activiteit </h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="naam" name="naam" placeholder="Naam">
                <label for="naam">Naam</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="locatie" name="locatie" placeholder="Locatie">
                <label for="locatie">Locatie</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="eten" name="eten">
                <label class="form-check-label" for="eten">Eten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="maxDeelnemers" name="maxDeelnemers" placeholder="1">
                <label for="maxDeelnemers">Maximale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="minDeelnemers" name="minDeelnemers" placeholder="1">
                <label for="minDeelnemers">Minimale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kosten" name="kosten" placeholder="Kosten">
                <label for="kosten">Kosten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="benodigdheden" name="benodigdheden" placeholder="Benodigdheden">
                <label for="benodigdheden">Benodigdheden</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="omschrijving" name="omschrijving" placeholder="Omschrijving">
                <label for="omschrijving">Omschrijving</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="activiteit_datum" name="activiteit_datum" placeholder="datum">
                <label for="activiteit_datum">activiteit datum</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_begin_tijd" name="activiteit_begin_tijd" placeholder="activiteit beginTijd"> 
                <label for="activiteit_begin_tijd">startTijd</label>
            </div>
            <div class="form-floating mb-3"> 
                <input type="time" class="form-control" id="activiteit_eindtijd" name="activiteit_eindtijd" placeholder="eindTijd"> 
                <label for="activiteit_eindtijd">eindTijd</label>
            </div>
            <div class="mb-3">
                <label for="afbeelding" class="form-label"><b>Afbeelding</b></label>
                <input class="form-control" type="file" id="afbeelding" name="afbeelding">
            </div>
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="Submit" class="btn btn-primary mt-1" name="bewerken" value="bewerken">
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