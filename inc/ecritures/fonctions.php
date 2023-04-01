<?php
    function dbconnect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
    
            try {
                $connexion = new PDO('pgsql:host='.$PARAM_hote.'.;port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
                return $connexion;
            }
            catch(Exception $e) {
                echo 'Erreur : '.$e-> getMessage().'<br />';
                echo 'N° : '.$e-> getCode();
            }
    }

/// écriture journal 

    function save_ecriture($journal, $societe, $date_ecriture, $numero_piece, $cg, $ct, $libelle, $debit, $credit, $devise, $montant_devise, $taux) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();
    
            $sql = "INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, compte_tiers, libelle, debit, credit, devise, montant_devise, taux) 
                    VALUES(:journal, :societe, :date_ecriture, :numero_piece, :compte_general, :compte_tiers, :libelle, :debit, :credit, :devise, :montant_devise, :taux)";
           
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':journal', $journal);
            $stmt->bindParam(':societe', $societe);
            $stmt->bindParam(':numero_piece', $numero_piece);
            $stmt->bindParam(':compte_general', $cg);
            $stmt->bindParam(':compte_tiers', $ct);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':debit', $debit);
            $stmt->bindParam(':credit', $credit);
            $stmt->bindParam(':devise', $devise);
            $stmt->bindParam(':montant_devise', $montant_devise);
            $stmt->bindParam(':taux', $taux);
    
            $stmt->execute();
            $connexion->commit();
        
            return true;
            
        } catch (Exception $e) {
            $connexion->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function find($devise) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM devise WHERE devise = :devise";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':devise', $devise);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function find_societe($societe) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM societe WHERE nom = :nom";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':nom', $societe);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

    function get_all_by_journal($code, $societe) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM ecriture_journal WHERE (journal=:journal AND societe=:societe)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':journal', $code);
        $stmt->bindParam(':societe', $societe);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }  
?>