<?php
    session_start();

    include "header.php";

    if (!isset($_SESSION['covadiaan'])) {
        header("Location: index.php");
        exit();
    }

    // if(!isset($_SESSION["activiteit"]) && !isset($_SESSION["covadiaan_id"])) {
    //     header("Location: activiteiten.php");
    //     exit();
    // }

    $covadiaan_id = $_SESSION['covadiaan_id'];
    $activiteit = $_SESSION['activiteit'];
?>

<head>
    <link rel="stylesheet" href="css/inschrijving.css">
</head>

<div class="container">
    <h2>Inschrijven voor <?= $activiteit["activiteit_naam"]; ?></h2>
</div>