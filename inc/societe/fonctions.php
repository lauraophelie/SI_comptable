<?php
    function db_connect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
            try {
                $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
                return $connexion;
            }catch(Exception $e) {
                echo 'Erreur : '.$e-> getMessage().'<br />';
                echo 'N° : '.$e-> getCode();
            }
    }

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function save($nom, $objet, $date_creation, $mdp) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO societe (nom, objet, date_creation, mot_de_passe) VALUES (:nom, :objet, :date_creation,:mdp)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':objet', $objet);
            $stmt->bindParam(':date_creation', $date_creation);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }
    function addScanNRCS($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_nrcs = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addScanNS($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_ns = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addScanNIF($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_nif = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addLogo($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE societe SET logo = :filename WHERE id = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }

    function getDevise(){
        $connexion = db_connect();
        $sql = "SELECT * FROM devise ORDER BY id ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function lastID(){
        $connexion = db_connect();
        $sql = "SELECT id FROM societe ORDER BY id DESC LIMIT 1";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function saveCompta($id_societe,$capital,$date_debut_exercice,$devise_tenu){
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO comptabilite(societe,capital, date_debut_exercice, devise) VALUES(:societe,:capital,:date_debut, :devise)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $id_societe);
            $stmt->bindParam(':capital', $capital);
            $stmt->bindParam(':date_debut', $date_debut_exercice);
            $stmt->bindParam(':devise', $devise_tenu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }

    function findAll() {
        $connexion = db_connect();
        $sql = "SELECT * FROM v_infos_societe ORDER BY id ASC";
        $stmt = $connexion->prepare($sql);
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function findById($id){
        $connexion = db_connect();
        $sql = "SELECT * FROM v_infos_societe WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function findDetails($id){
        $connexion = db_connect();
        $sql = "SELECT * FROM v_infos_general WHERE societe = :id";
        $stmt = $connexion->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function setAdresse($id){
        try {
            $connexion = db_connect();
            $sql = "INSERT adresses_societe(societe) VALUES(:id)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }

    function setIdent($id){
        try {
            $connexion = db_connect();
            $sql = "INSERT identification_societe(societe) VALUES(:id)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
?>