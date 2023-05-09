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
    
            $sql = sprintf(
                "INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, compte_tiers, libelle, debit, credit, devise, montant_devise, taux) 
                VALUES('%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d)",
                $journal, $societe, $date_ecriture, $numero_piece, $cg, $ct, $libelle, $debit, $credit, $devise, $montant_devise, $taux
            );
    
            $stmt = $connexion->prepare($sql);
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

    function find_societe_comptabilite($id) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM comptabilite WHERE societe = :societe ORDER BY date_debut_exercice DESC";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_all_by_journal($code, $societe, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM ecriture_journal WHERE (journal=:journal AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin) ORDER BY compte_general ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':journal', $code);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }  

    function get_recent_ecritures($code, $societe, $date_exercice, $date_fin, $limite = 5) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM ecriture_journal WHERE (journal=:journal AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin) ORDER BY date_ecriture DESC LIMIT :limite";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':journal', $code);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':limite', $limite);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_sum_debit_journal($journal, $societe, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT SUM(debit) FROM ecriture_journal WHERE (journal=:journal AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':journal', $journal);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    function get_sum_credit_journal($journal, $societe, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT SUM(credit) FROM ecriture_journal WHERE (journal=:journal AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':journal', $journal);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

/// comptes 6 

    function insert_param_compte_6($compte_6, $fixe, $variable, $inc, $n_inc) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();
            $sql = "INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc, n_inc) VALUES('%s', %d, %d, %d, %d)";
            $sql = sprintf($sql, $compte_6, $fixe, $variable, $inc, $n_inc);

            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $connexion->commit();

            return true;
        } catch(Exception $e) {
            $connexion->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function insert_produit_compte_6($id_compte_6, $id_produit, $pourcentage) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();

            $sql = sprintf("INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage) VALUES('%s', %d, %d)", 
                            $id_compte_6, $id_produit, $pourcentage);
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $connexion->commit();
            
            return true;
        } catch(Exception $e) {
            $connexion->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function insert_centre_compte_6($id_compte_6, $id_centre, $pourcentage) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();

            $sql = sprintf("INSERT INTO compte_6_centre(id_compte_6, id_centre, pourcentage) VALUES('%s', %d, %d)", 
                            $id_compte_6, $id_centre, $pourcentage);
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $connexion->commit();
            
            return true;
        } catch(Exception $e) {
            $connexion->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function get_all_produit() {
        $connexion = dbconnect();
        $sql = "SELECT * FROM produit";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_all_centre() {
        $connexion = dbconnect();
        $sql = "SELECT * FROM centre";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function check_pourcentages_compte_6($compte_6) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM pourcentage_compte_6 WHERE id_compte_6=:id_compte_6";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_compte_6', $compte_6);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>