<?php
    function db_connect() {
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

/// capitaux propres 

    function get_sum_produits($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM ecriture_journal WHERE(compte_general LIKE '7%' AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_sum_charges($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM ecriture_journal WHERE(compte_general LIKE '6%' AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_solde_capital($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero = '10100' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function get_solde_produits($societe_id, $date_exercice, $date_fin) {
        $produits = get_sum_produits($societe_id, $date_exercice, $date_fin);
        $debit = $produits['total_debit'];
        $credit = $produits['total_credit'];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function get_solde_charges($societe_id, $date_exercice, $date_fin) {
        $charges = get_sum_charges($societe_id, $date_exercice, $date_fin);
        $debit = $charges['total_debit'];
        $credit = $charges['total_credit'];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function calcul_resultat_net($societe_id, $date_exercice, $date_fin) {
        $produits = get_solde_produits($societe_id, $date_exercice, $date_fin);
        $charges = get_solde_charges($societe_id, $date_exercice, $date_fin);
        return $produits - $charges;
    }

    function reserves_legales($societe_id, $date_exercice, $date_fin) {
        $resultat_net = calcul_resultat_net($societe_id, $date_exercice, $date_fin);
        $reserves_legales = 0;
        if($resultat_net > 0) {
            $reserves_legales = ($resultat_net * 5) / 100;
        } else {
            $reserves_legales = 0;
        }
        return $reserves_legales;
    }

    function get_resultat_en_instance($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero = '12800' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function resultat_en_instance($societe_id, $date_exercice, $date_fin) {
        $resultat = get_resultat_en_instance($societe_id, $date_exercice, $date_fin);
        $debit = $resultat['total_debits'];
        $credit = $resultat['total_credits'];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function get_capital($societe_id, $date_exercice, $date_fin) {
        $societe_compta = find_societe_comptabilite($societe_id);
        $soldes = get_solde_capital($societe_id, $date_exercice, $date_fin);
        
        $total_credits = $societe_compta['capital'] + $soldes['total_credits'];
        $total_debits = $soldes['total_debits'];
        
        $capital = 0;

        if($total_debits > $total_credits) {
            $capital = $total_debits - $total_credits;
        } else if($total_credits > $total_debits) {
            $capital = $total_credits - $total_debits;
        } else {
            $capital = 0;
        }
        return $capital;
    }

    function solde_autres_capitaux($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero LIKE '11%' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function autres_capitaux($societe_id, $date_debut, $date_fin_exercice) {
        $resultat = solde_autres_capitaux($societe_id, $date_debut, $date_fin_exercice);
        $debit = $resultat['total_debits'];
        $credit = $resultat['total_credits'];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function capitaux_propres($societe_id, $date_debut, $date_fin_exercice) {

        $capital = get_capital($societe_id, $date_debut, $date_fin_exercice);
        $resultat = calcul_resultat_net($societe_id, $date_debut, $date_fin_exercice);
        $resultat_instance = resultat_en_instance($societe_id, $date_debut, $date_fin_exercice);
        $reserves_legales = reserves_legales($societe_id, $date_debut, $date_fin_exercice);
        $autres_capitaux = autres_capitaux($societe_id, $date_debut, $date_fin_exercice);

        $passifs = array(
            "capital" => $capital,
            "resultat" => $resultat,
            "resultat_instance" => $resultat_instance,
            "reserves_legales" => $reserves_legales,
            "autres_capitaux" => $autres_capitaux
        );
        return $passifs;
    }

/// passifs courants 

    function get_tresoreries($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_compte_tresorerie
                WHERE (societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function solde_tresorerie_passifs($societe_id, $date_debut, $date_fin_exercice) {
        $soldes = get_tresoreries($societe_id, $date_debut, $date_fin_exercice);
        $debit = $soldes["total_debits"];
        $credit = $soldes["total_credits"];

        if($debit > $credit || $debit == $credit) return 0;
        else return $credit - $debit; 
    }

    function get_fournisseurs($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero LIKE '40%' OR libelle LIKE '%FOURNISSEUR%' OR libelle LIKE '%FRNS%' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function solde_fournisseurs($societe_id, $date_debut, $date_fin_exercice) {
        $soldes = get_fournisseurs($societe_id, $date_debut, $date_fin_exercice);
        $debit = $soldes["total_debits"];
        $credit = $soldes["total_credits"];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function solde_dettes_courts_termes($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero LIKE '165%' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function dettes_court_termes($societe_id, $date_debut, $date_fin_exercice) {
        $soldes = solde_dettes_courts_termes($societe_id, $date_debut, $date_fin_exercice);
        $debit = $soldes["total_debits"];
        $credit = $soldes["total_credits"];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function solde_autres_dettes($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero LIKE '40%' OR libelle NOT LIKE '%FOURNISSEUR%' OR libelle NOT LIKE '%FRNS%' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function autres_dettes($societe_id, $date_debut, $date_fin_exercice) {
        $soldes = solde_autres_dettes($societe_id, $date_debut, $date_fin_exercice);
        $debit = $soldes["total_debits"];
        $credit = $soldes["total_credits"];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function passifs_courants($societe_id, $date_debut, $date_fin_exercice) {
        $tresorerie = solde_tresorerie_passifs($societe_id, $date_debut, $date_fin_exercice);
        $fournisseurs = solde_fournisseurs($societe_id, $date_debut, $date_fin_exercice);
        $dettes_court_termes = dettes_court_termes($societe_id, $date_debut, $date_fin_exercice);
        $autres_dettes = autres_dettes($societe_id, $date_debut, $date_fin_exercice);

        $passifs = array(
            "tresorerie" => $tresorerie,
            "fournisseurs" => $fournisseurs,
            "dettes_court_termes" => $dettes_court_termes,
            "autres_dettes" => $autres_dettes
        );
        return $passifs;
    }

/// passifs non courants

    function solde_impots_differes($societe_id, $date_debut, $date_fin_exercice) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero LIKE '130%' AND LIKE '%IMPOTS DIFFERES%' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function impots_differes($societe_id, $date_debut, $date_fin_exercice) {
        $soldes = solde_impots_differes($societe_id, $date_debut, $date_fin_exercice);
        $debit = $soldes["total_debits"];
        $credit = $soldes["total_credits"];

        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function passifs_non_courants($societe_id, $date_debut, $date_fin_exercice) {
        $impots_differes = impots_differes($societe_id, $date_debut, $date_fin_exercice);
        $passifs_non_courants = array(
            "impots_differes" => $impots_differes
        );
        return $passifs_non_courants;
    }

/// total 

    function somme_valeurs($tab) {
        $somme = 0;
        foreach($tab as $valeur) {
            $somme += $valeur;
        }
        return $somme;
    }    

    function somme_totale($societe_id, $date_debut, $date_fin_exercice) {
        $capitaux_propres = capitaux_propres($societe_id, $date_debut, $date_fin_exercice);
        $passifs_courants = passifs_courants($societe_id, $date_debut, $date_fin_exercice);
        $passifs_non_courants = passifs_non_courants($societe_id, $date_debut, $date_fin_exercice);
        $somme_totale = somme_valeurs($capitaux_propres) + somme_valeurs($passifs_courants) + somme_valeurs($passifs_non_courants);

        return $somme_totale;
    }
    
?>