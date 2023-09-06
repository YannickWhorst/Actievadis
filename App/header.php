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
        if (!isset($_SESSION['covadiaan'])) { ?>
        <a class="logInLink" href="inloggen.php">Inloggen</a>
        <?php } ?>
    </header>
</body>