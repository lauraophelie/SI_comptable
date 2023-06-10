<?php

/// connexion à la base de données
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

    function save_ecritures_charges($societe, $date_ecriture, $numero_piece, $compte_general, $libelle, $unite_oeuvre, $quantite, $montant) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();
            
            $sql = "INSERT INTO ecriture_charges(societe, date_ecriture, numero_piece, compte_general, libelle, unite_oeuvre, quantite, montant) 
            VALUES(%d, '%s', '%s', '%s', '%s', %d, %d, %d)";
            $sql = sprintf($sql
                ,
                $societe, $date_ecriture, $numero_piece, $compte_general, $libelle, $unite_oeuvre, $quantite, $montant
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

    function get_last_charge($societe, $compte_6) {
        $connexion = dbconnect();

        $sql = "SELECT * FROM v_ecritures_charges 
                WHERE (societe = :societe AND numero_compte = :numero_compte) 
                ORDER BY num DESC LIMIT 1";

        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(":societe", $societe);
        $stmt->bindParam(":numero_compte", $compte_6);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result == false) {
            $errorInfo = $stmt->errorInfo();
            print_r($errorInfo);
        } else {
            return $result;
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

/// somme débits

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
/// somme crédits

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

/// comptes 6, clé de répartition

function insert_nature_compte_6($compte_6, $inc, $n_inc) {
    try {
        $connexion = dbconnect();
        $connexion->beginTransaction();
        
        $sql = "INSERT INTO nature_compte_6(id_compte_6, inc, n_inc) VALUES(:compte_6, :inc, :n_inc)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':compte_6', $compte_6);
        $stmt->bindValue(':inc', $inc);
        $stmt->bindValue(':n_inc', $n_inc);
        
        $stmt->execute();
        $connexion->commit();

        return true;
    } catch(Exception $e) {
        $connexion->rollback();
        echo "Error: " . $e->getMessage();
        return false;
    }
}


    function get_nature_compte_6($compte_6) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM nature_compte_6 WHERE id_compte_6 = :compte_6";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':compte_6', $compte_6);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert_compte_6_produit($id_compte_6, $id_produit, $pourcentage, $fixe, $variable) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();

            $sql = sprintf("INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage, fixe, variable) VALUES('%s', %d, %d, %d, %d)", 
                            $id_compte_6, $id_produit, $pourcentage, $fixe, $variable);
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

    function get_cle_compte_6_produit($compte_6) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM v_cle_rep_produit_compte_6 WHERE numero_compte=:compte_6";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':compte_6', $compte_6);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert_repartition_produit_centre($id_compte_6, $id_produit, $id_centre, $fixe, $variable) {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();

            $sql = sprintf("INSERT INTO repartition_produit_centre(id_compte_6, id_produit, id_centre, fixe, variable) VALUES('%s', %d, %d, %d, %d)", 
                            $id_compte_6, $id_produit, $id_centre, $fixe, $variable);
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

    function get_cle_rep_produit_centre($compte_6) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM v_cle_rep_produit_centre WHERE numero_compte=:compte_6";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':compte_6', $compte_6);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_all_produit() {
        $connexion = dbconnect();
        $sql = "SELECT * FROM produit ORDER BY id ASC";
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

    function reset_cles_rep_produit_centre() {
        try {
            $connexion = dbconnect();
            $connexion->beginTransaction();
            
            $sql1 = "DELETE FROM compte_6_produit";
            $stmt1 = $connexion->prepare($sql1);
            $stmt1->execute();
        
            $sql2 = "DELETE FROM repartition_produit_centre";
            $stmt2 = $connexion->prepare($sql2);
            $stmt2->execute();
            
            $connexion->commit();
            return true;
        } catch(Exception $e) {
            $connexion->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

/// coûts par produits, par centres, par centres et par produits, coûts de revient

    function cout_par_produit($produit, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT DISTINCT produit, produit_id, SUM(fixe) as fixe, SUM(variable) as variable
                FROM v_couts_produits 
                WHERE (produit_id = :produit_id AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)
                GROUP BY produit, produit_id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':produit_id', $produit);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function cout_par_centre_produit($produit, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT DISTINCT produit, produit_id, id_centre, centre, SUM(fixe) as fixe, SUM(variable) as variable 
                FROM v_couts_produits_centres 
                WHERE (produit_id = :produit_id AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin) 
                GROUP BY produit, produit_id, id_centre, centre";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':produit_id', $produit);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function cout_par_centre($centre, $date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT DISTINCT centre, id_centre, SUM(fixe) as fixe, SUM(variable) as variable
                FROM v_couts_centre
                WHERE (id_centre = :centre_id AND date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)
                GROUP BY centre, id_centre";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':centre_id', $centre);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function all_couts_centre($date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT DISTINCT centre, id_centre, SUM(fixe) as fixe, SUM(variable) as variable
                FROM v_couts_centre
                WHERE (date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)
                GROUP BY centre, id_centre";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':centre_id', $centre);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function cout_par_nature($date_exercice, $date_fin) {
        $connexion = dbconnect();
        $sql = "SELECT SUM(fixe) as fixe, SUM(variable) as variable
                FROM v_couts_nature
                WHERE (date_ecriture >= :date_exercice AND date_ecriture <= :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function cout_revient($volume_production, $somme_charges) {
        return ($somme_charges / $volume_production);
    }
?>