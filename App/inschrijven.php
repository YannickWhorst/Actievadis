<?php
    include "header.php";

    if (!(isset($_SESSION['covadiaan']) || isset($_SESSION['guest']))) {
        header("Location: index.php");
        exit();
    }

    if(!isset($_POST['activiteit_id']) || !(isset($_SESSION['covadiaan_id']) || isset($_SESSION['guest']))) {
        header("Location: activiteiten.php");
        exit();
    }

    $activiteit_id = $_POST["activiteit_id"];

    $naam;
    if (isset($_SESSION['covadiaan'])) {
        $covadiaan_id = $_SESSION['covadiaan_id'];
        $sql = "SELECT covadiaan_naam FROM covadiaan WHERE id = " . $covadiaan_id;
        $stmt = db_getData($sql);
        $naam = $stmt->fetch(PDO::FETCH_ASSOC)['covadiaan_naam'];
    } else {
        $naam = $_SESSION['guest'];
    }
    

    $sql = "SELECT id, activiteit_naam FROM activiteit WHERE id = " . $activiteit_id;
    $stmt = db_getData($sql);
    $activiteit = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['inschrijven_activiteit'])) {
        $opmerking = isset($_POST['opmerking']) ? $_POST['opmerking'] : NULL;

        $sql;
        if (isset($_SESSION['covadiaan'])) {
            $covadiaan_id = $_SESSION['covadiaan_id'];
            $sql = "INSERT INTO `inschrijving`(`activiteit_id`, `covadiaan_id`, `inschrijving_opmerking`) 
                VALUES ('$activiteit_id','$covadiaan_id','$opmerking')";
        } else {
            $covadiaan_id = $_SESSION['covadiaan_id'];
            $sql = "INSERT INTO `inschrijving`(`activiteit_id`, `gast_naam`, `inschrijving_opmerking`) 
                VALUES ('$activiteit_id','$naam','$opmerking')";
        }
        
        
        if(db_insertData($sql)) {
            $_SESSION["ingeschreven"] = true;
            header("Location: activiteiten.php");
            exit();
        } else {
            echo "Er is iets mis gegaan!";
        }
    }
?>

<div class="container">
    <h2><b><?= $naam ?></b>, inschrijven voor <b><?= $activiteit["activiteit_naam"]; ?></b>.</h2>
    <form method="post" action="">
        <div class="form-floating mb-3 w-25">
            <textarea type="text" class="form-control" id="opmerking" name="opmerking" placeholder="Opmerking"></textarea>
            <label for="opmerking">Opmerking</label>
        </div>
        <input type="hidden" name="activiteit_id" value="<?php echo $activiteit['id']; ?>">
        <input type="submit" name="inschrijven_activiteit" value="Inschrijven">
    </form>
</div>

<?php
    include "footer.php";
?>