<?php
    session_start();
    
    include "./config/database_functions.php";
    include "./config/database_config.php";
?>
<head>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="css/header.css" type="text/css" rel="stylesheet">
    <title>Actievadis</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
</head>
<body>
    <header>
        <a href="index.php">
            <img class="headerLogo" src="img/logo_covadis_2016.png"></img>
        </a>
        <?php
        if (!(isset($_SESSION['covadiaan']) || isset($_SESSION['guest']))) { ?>
        <a class="headerLink" href="index.php">Inloggen</a>
        <?php } ?>
        <?php
        if (isset($_SESSION['covadiaan'])) {
        if ($_SESSION['rol_id'] == "2") { ?>
        <a class="headerLink" href="accountBeheer.php">Account beheer</a>
        <a class="headerLink" href="activiteitenBeheer.php">Activiteiten beheer</a>
        <a class="headerLink" href="inschrijvingenOverzicht.php">Overzicht inschrijvingen</a>
        
        <?php } else { ?>
        <a class="headerLink" href="mijnActiviteiten.php">Mijn activiteiten</a>
        <?php } } elseif (isset($_SESSION['guest'])) { ?>
        <a class="headerLink" href="mijnActiviteiten.php">Mijn activiteiten</a>
        <?php } ?>
        <form action="#" method="POST">
            <input type="submit" class="btn headerLink" value="Uitloggen" name="uitloggen">
        </form>
    </header>
</body>

<?php
    if(isset($_POST['uitloggen'])) {
        if(isset($_SESSION['covadiaan'])){
            $_SESSION['covadiaan'] = null;
            $_SESSION['covadiaan_id'] = null;
            $_SESSION['rol_id'] = null;
        } else if(isset($_SESSION['guest'])) {
            $_SESSION['guest'] = null;
        }
    }
?>
