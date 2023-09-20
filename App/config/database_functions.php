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

    function db_deleteData($id) {
        try {
            $db = db_connect();
            $queryPDO = $db->prepare("DELETE FROM covadiaan WHERE id = :id");
            $queryPDO->bindParam(':id', $id, PDO::PARAM_INT);

            if($queryPDO->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            die("Error: " . $e-getMessage());
            return false;
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
