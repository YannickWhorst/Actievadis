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

    // Database informatie in de database stoppen 
    function db_insertData($query) {
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
