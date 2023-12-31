<?php

// Database connect 
    function db_connect(){
        try {
            $db = new PDO(dbHost, username, password);
            return $db;
        } catch (PDOException $e) {
            die("Error!:" . $e->getMessage());
        }
    }

    // Database Informatie verkrijgen 
    function db_getData($query) {
        try{
            $db = db_connect();
            $queryPDO = $db->prepare($query);
            $queryPDO->execute();
            $db = null;
            return $queryPDO;
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        
    }

    function db_deleteData($id, $tabel) {
        try {
            $db = db_connect();
            $queryPDO = $db->prepare("DELETE FROM $tabel WHERE id = :id");
            $queryPDO->bindParam(':id', $id, PDO::PARAM_INT);

            if($queryPDO->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            //die("Error: " . $e-getMessage());
            return false;
        }
    }

    function db_deleteInschrijvingen($activiteit_id) {
        try {
            $db = db_connect();
            $queryPDO = $db->prepare("DELETE FROM inschrijving WHERE activiteit_id = :id");
            $queryPDO->bindParam(':id', $activiteit_id, PDO::PARAM_INT);

            if($queryPDO->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            //die("Error: " . $e-getMessage());
            return false;
        }
    }

    function db_uitschrijven($id, $activiteit_id) {
        try {
            $db = db_connect();
            $queryPDO = $db->prepare("DELETE FROM inschrijving WHERE covadiaan_id = :id AND activiteit_id = :activiteit_id");
            $queryPDO->bindParam(':id', $id, PDO::PARAM_INT);
            $queryPDO->bindParam(':activiteit_id', $activiteit_id, PDO::PARAM_INT);

            if($queryPDO->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    function db_uitschrijvenGast($gast_naam, $activiteit_id) {
        try {
            $db = db_connect();
            $queryPDO = $db->prepare("DELETE FROM inschrijving WHERE gast_naam = :gast_naam AND activiteit_id = :activiteit_id");
            $queryPDO->bindParam(':gast_naam', $gast_naam, PDO::PARAM_STR);
            $queryPDO->bindParam(':activiteit_id', $activiteit_id, PDO::PARAM_INT);

            if($queryPDO->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    function db_addVisit($activiteitId) {
        if (isset($_SESSION['covadiaan'])) {
            $covadiaanId = $_SESSION['covadiaan_id'];
            $visitedBefore = db_getData("SELECT * FROM visites WHERE `covadiaan_id` = $covadiaanId AND `activiteit_id` = $activiteitId")->fetch(PDO::FETCH_ASSOC);
            if ($visitedBefore != null) {
                db_insertData("UPDATE visites SET `aantal` = `aantal` + 1 WHERE 'covadiaan_id' = $covadiaanId AND `activiteit_id` = $activiteitId");
            } else {
                db_insertData("INSERT INTO visites (covadiaan_id, activiteit_id, aantal) VALUES ($covadiaanId, $activiteitId, 1)");
            }
        } else {
            $guestName = $_SESSION['guest'];
            $visitedBefore = db_getData("SELECT * FROM visites WHERE `gast_naam` = '$guestName' AND `activiteit_id` = $activiteitId")->fetch(PDO::FETCH_ASSOC);
            if ($visitedBefore != null) {
                db_insertData("UPDATE visites SET `aantal` = `aantal` + 1 WHERE `gast_naam` = '$guestName' AND `activiteit_id` = $activiteitId");
            } else {
                db_insertData("INSERT INTO visites (gast_naam, activiteit_id, aantal) VALUES ('$guestName', $activiteitId, 1)");
            }
        }
    }

    // Database informatie in de database stoppen 
    function db_insertData($query) {
        try{
            $db = db_connect();
            $queryPDO = $db->prepare($query);
            $queryPDO->execute();
            $db = null;
            return true;
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    // Database user inserten
    function db_insertUser($query){
        try{
            $db = db_connect();
            $queryPDO = $db->prepare($query);
            $queryPDO->execute();
            $db = null;
            return $queryPDO;
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    function getCovadiaan($vNaam, $aNaam, $email) {
        $user = db_getData("SELECT * FROM users WHERE covadiaan_naam='$vNaam' AND covaidaan_naam='$aNaam' AND covaidaan_email='$email'");
        if ($user->rowCount() > 0){
            return $user;
        } else {
            return "No user found";
        }
    }

    function db_updateCovadiaan($id, $email, $name, $password, $rolId) {
        try {
            $db = db_connect();
            $query = "UPDATE `covadiaan` SET `covadiaan_email` = :email, `covadiaan_naam` = :name, `covadiaan_wachtwoord` = :password, `covadiaan_rol_id` = :rolId WHERE `id` = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':rolId', $rolId, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    function db_updateActiviteit($id, $naam, $locatie, $eten, $minDeelnemers, $maxDeelnemers, $kosten, $benodigdheden, $omschrijving, $datum, $startTijd, $eindTijd) {
        try {
            $db = db_connect();
            $query = "UPDATE `activiteit` SET 
                `activiteit_naam` = :naam,
                `activiteit_locatie` = :locatie,
                `activiteit_eten` = :eten,
                `activiteit_min_deelnemers` = :minDeelnemers,
                `activiteit_max_deelnemers` = :maxDeelnemers,
                `activiteit_kosten` = :kosten,
                `activiteit_benodigdheden` = :benodigdheden,
                `activiteit_omschrijving` = :omschrijving,
                `activiteit_datum` = :datum,
                `activiteit_begin_tijd` = :startTijd,
                `activiteit_eindtijd` = :eindTijd
                WHERE `id` = :id";
               
            $stmt = $db->prepare($query);
            $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
            $stmt->bindParam(':locatie', $locatie, PDO::PARAM_STR);
            $stmt->bindParam(':eten', $eten, PDO::PARAM_INT);
            $stmt->bindParam(':minDeelnemers', $minDeelnemers, PDO::PARAM_INT);
            $stmt->bindParam(':maxDeelnemers', $maxDeelnemers, PDO::PARAM_INT);
            $stmt->bindParam(':kosten', $kosten, PDO::PARAM_STR);
            $stmt->bindParam(':benodigdheden', $benodigdheden, PDO::PARAM_STR);
            $stmt->bindParam(':omschrijving', $omschrijving, PDO::PARAM_STR);
            $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
            $stmt->bindParam(':startTijd', $startTijd, PDO::PARAM_STR);
            $stmt->bindParam(':eindTijd', $eindTijd, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
             
            if ($stmt->execute()) {
                echo "Query uitgevoerd successfully<br>";
                return true;
            } else {
                echo "Fout bij het uitvoeren van de query: " . implode(" - ", $stmt->errorInfo()) . "<br>";
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }
    
