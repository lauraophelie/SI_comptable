CREATE TABLE IF NOT EXISTS nature_compte_6(
    id_compte_6 VARCHAR(5) REFERENCES pcg2005(numero),
    inc BOOLEAN DEFAULT FALSE,
    n_inc BOOLEAN DEFAULT FALSE
);

ALTER TABLE nature_compte_6 ADD CONSTRAINT check_compte_6 UNIQUE(id_compte_6);

SELECT compte_general, debit as valeur, date_ecriture
FROM ecriture_journal
WHERE compte_general LIKE '6%'
ORDER BY date_ecriture;

CREATE OR REPLACE VIEW v_comptes_6 AS(
    SELECT compte_general, debit as valeur, date_ecriture
    FROM ecriture_journal
    WHERE compte_general LIKE '6%'
    ORDER BY date_ecriture
);

CREATE TABLE IF NOT EXISTS compte_6_produit(
    id_compte_6 VARCHAR(5) REFERENCES pcg2005(numero),
    id_produit INTEGER REFERENCES produit(id),
    pourcentage DECIMAL DEFAULT 0,
    fixe DECIMAL DEFAULT 0,
    variable DECIMAL DEFAULT 0
);

ALTER TABLE compte_6_produit ADD CONSTRAINT paire_produit_compte_6 UNIQUE(id_compte_6, id_produit);
ALTER TABLE compte_6_produit ADD CONSTRAINT check_valeur_pourcentage CHECK(pourcentage <= 100);
ALTER TABLE compte_6_produit ADD CONSTRAINT check_val_fixe CHECK (fixe <= 100);
ALTER TABLE compte_6_produit ADD CONSTRAINT check_val_variable CHECK (variable <= 100);

CREATE TABLE IF NOT EXISTS repartition_produit_centre(
    id_compte_6 VARCHAR(5) REFERENCES pcg2005(numero),
    id_produit INTEGER REFERENCES produit(id),
    id_centre INTEGER REFERENCES centre(id),
    fixe DECIMAL DEFAULT 0,
    variable DECIMAL DEFAULT 0
);

ALTER TABLE repartition_produit_centre ADD CONSTRAINT compte_produit_centre UNIQUE(id_compte_6, id_produit, id_centre);
ALTER TABLE repartition_produit_centre ADD CONSTRAINT check_val_fixe CHECK (fixe <= 100);
ALTER TABLE repartition_produit_centre ADD CONSTRAINT check_val_variable CHECK (variable <= 100);

SELECT 
    rpc.id_compte_6, 
    pcg2005.compte_6, 
    produit.produit_id, 
    produit.produit, 
    centre.centre_id, 
    centre.centre, 
    rpc.fixe, 
    rpc.variable
FROM repartition_produit_centre rpc
JOIN (SELECT numero, designation as compte_6 FROM pcg2005) AS pcg2005 ON rpc.id_compte_6 = pcg2005.numero
JOIN (SELECT id as produit_id, designation as produit FROM produit) AS produit ON rpc.id_produit = produit.produit_id
JOIN (SELECT id as centre_id, designation as centre FROM centre) AS centre ON rpc.id_centre = centre.centre_id;

CREATE OR REPLACE VIEW v_repartition_produit_centre AS(
    SELECT rpc.id_compte_6, pcg2005.compte_6, produit.produit_id, produit.produit, centre.centre_id, centre.centre, rpc.fixe, rpc.variable
    FROM repartition_produit_centre rpc
    JOIN (SELECT numero, designation as compte_6 FROM pcg2005) AS pcg2005 ON rpc.id_compte_6 = pcg2005.numero
    JOIN (SELECT id as produit_id, designation as produit FROM produit) AS produit ON rpc.id_produit = produit.produit_id
    JOIN (SELECT id as centre_id, designation as centre FROM centre) AS centre ON rpc.id_centre = centre.centre_id
);

INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage, fixe, variable) VALUES('60100', 1, 25, 25, 75);
INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage, fixe, variable) VALUES('60200', 1, 15, 80, 20);
INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage, fixe, variable) VALUES('60100', 2, 75, 50, 50);


SELECT
	v_comptes_6.date_ecriture,
	id_compte_6 AS numero_compte,
    pcg2005.designation AS compte,
	produit.designation AS produit,
	pourcentage,
	((pourcentage * v_comptes_6.valeur) / 100) AS valeur_totale,
	fixe,
	(((pourcentage * v_comptes_6.valeur) / 100) * fixe) / 100 AS valeur_fixe,
	variable,
	(((pourcentage * v_comptes_6.valeur) / 100) * variable) / 100 AS valeur_variable
FROM
	compte_6_produit
    JOIN pcg2005 ON compte_6_produit.id_compte_6 = pcg2005.numero
	JOIN produit ON compte_6_produit.id_produit = produit.id
	JOIN v_comptes_6 ON compte_6_produit.id_compte_6 = v_comptes_6.compte_general;


CREATE OR REPLACE VIEW v_repartition_produit_compte_6 AS(
    SELECT
        v_comptes_6.date_ecriture,
        id_compte_6 AS numero_compte,
        pcg2005.designation AS compte,
        produit.designation AS produit,
        pourcentage,
        ((pourcentage * v_comptes_6.valeur) / 100) AS valeur_totale,
        fixe,
        (((pourcentage * v_comptes_6.valeur) / 100) * fixe) / 100 AS valeur_fixe,
        variable,
        (((pourcentage * v_comptes_6.valeur) / 100) * variable) / 100 AS valeur_variable
    FROM
        compte_6_produit
        JOIN pcg2005 ON compte_6_produit.id_compte_6 = pcg2005.numero
        JOIN produit ON compte_6_produit.id_produit = produit.id
        JOIN v_comptes_6 ON compte_6_produit.id_compte_6 = v_comptes_6.compte_general
);

INSERT INTO repartition_produit_centre(id_compte_6, id_produit, id_centre, fixe, variable) VALUES('60100', 1, 1, 10, 20),
                                                                                                ('60100', 1, 2, 20, 30),
                                                                                                ('60100', 1, 3, 70, 50);

SELECT 
    v_rpc.date_ecriture,
    v_rpc.numero_compte,
    v_rpc.produit_id,
    v_rpc.produit,
    rpc.id_centre,
    centre.designation AS centre,
    rpc.fixe AS c_fixe,
    ((v_rpc.valeur_fixe * rpc.fixe) / 100) AS centre_fixe,
    rpc.variable AS c_variable,
    ((v_rpc.valeur_variable * rpc.variable) / 100) AS centre_variable
FROM repartition_produit_centre rpc 
JOIN centre on rpc.id_centre = centre.id
JOIN v_repartition_produit_compte_6 v_rpc ON rpc.id_produit = v_rpc.produit_id;

CREATE OR REPLACE VIEW v_repartition_produits_centre AS(
    SELECT 
        v_rpc.date_ecriture,
        v_rpc.numero_compte,
        v_rpc.produit_id,
        v_rpc.produit,
        rpc.id_centre,
        centre.designation AS centre,
        rpc.fixe AS c_fixe,
        ((v_rpc.valeur_fixe * rpc.fixe) / 100) AS centre_fixe,
        rpc.variable AS c_variable,
        ((v_rpc.valeur_variable * rpc.variable) / 100) AS centre_variable
    FROM repartition_produit_centre rpc 
    JOIN centre on rpc.id_centre = centre.id
    JOIN v_repartition_produit_compte_6 v_rpc ON rpc.id_produit = v_rpc.produit_id
);

-------------------------------------------------------- 16-05-2023 ------------------------------------------------

INSERT INTO unite_oeuvre(designation) VALUES('KG'), ('NB'), ('Cons Périodiques'), ('KW'), ('Litres'), ('Loyer Mensuel'),
                                            ('Heure de travail'), ('Salaire mensuel');

-------------------------------------------------------- 17-05-2023 -------------------------------------------------

SELECT
	DISTINCT(produit_id),
	produit,
	numero_compte,
	pourcentage AS cle,
	fixe,
	variable
FROM
	v_repartition_produit_compte_6
ORDER BY numero_compte ASC;

INSERT INTO compte_6_produit(id_compte_6, id_produit, pourcentage, fixe, variable) VALUES('60200', 2, 85, 80, 20);

INSERT INTO repartition_produit_centre(id_compte_6, id_produit, id_centre, fixe, variable) VALUES('60200', 1, 1, 10, 20),
                                                                                                ('60200', 1, 2, 20, 30),
                                                                                                ('60200', 1, 3, 70, 50);

CREATE OR REPLACE VIEW v_cle_rep_produit_compte_6 AS(
    SELECT
        DISTINCT(produit_id),
        produit,
        numero_compte,
        pourcentage AS cle,
        fixe,
        variable
    FROM
	    v_repartition_produit_compte_6
);

SELECT * FROM v_cle_rep_produit_compte_6 ORDER BY numero_compte ASC;

SELECT 
    DISTINCT(produit_id),
    produit, 
    numero_compte,
    id_centre,
    centre,
    c_fixe, 
    c_variable
FROM
    v_repartition_produits_centre
ORDER BY numero_compte ASC;

CREATE OR REPLACE VIEW v_cle_rep_produit_centre AS(
    SELECT 
        DISTINCT(produit_id),
        produit, 
        numero_compte,
        id_centre,
        centre,
        c_fixe, 
        c_variable
    FROM
        v_repartition_produits_centre
);

SELECT * FROM v_cle_rep_produit_centre ORDER BY numero_compte ASC;


--------------------------------------------------------- 24-05-2023 -----------------------------------------------------------

CREATE OR REPLACE VIEW v_charges AS(
    SELECT * from ecriture_journal where compte_general like '6%' and compte_general not like '68%'
);

--------- coûts par produits 

SELECT DISTINCT produit, produit_id, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY produit, produit_id;

CREATE OR REPLACE VIEW v_couts_produits AS(
    SELECT DISTINCT produit, produit_id, date_ecriture, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY produit, produit_id, date_ecriture
);

--------- coûts par produits et par centre

SELECT DISTINCT produit, produit_id, date_ecriture, id_centre, centre, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY produit, produit_id, id_centre, centre, date_ecriture;

CREATE OR REPLACE VIEW v_couts_produits_centres AS(   
    SELECT DISTINCT produit, produit_id, date_ecriture, id_centre, centre, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY produit, produit_id, id_centre, centre, date_ecriture
);

SELECT DISTINCT produit, produit_id, date_ecriture, id_centre, centre, SUM(fixe) as fixe, SUM(variable) as variable FROM v_couts_produits_centres GROUP BY produit, produit_id, id_centre, centre, date_ecriture;

----------------------------------------------------------- 27-05-2023 -----------------------------------------------------------

--------- coûts par centre

SELECT DISTINCT centre, id_centre, date_ecriture, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY id_centre, centre, date_ecriture;

CREATE OR REPLACE VIEW v_couts_centre AS(
    SELECT DISTINCT centre, id_centre, date_ecriture, SUM(centre_fixe) as fixe, SUM(centre_variable) as variable FROM v_repartition_produits_centre GROUP BY id_centre, centre, date_ecriture
);

SELECT DISTINCT centre, id_centre, date_ecriture, SUM(fixe) as fixe, SUM(variable) as variable FROM v_couts_centre GROUP BY id_centre, centre;

--------- coûts par nature 

SELECT DISTINCT date_ecriture, SUM(valeur_fixe) AS fixe, SUM(valeur_variable) AS variable FROM v_repartition_produit_compte_6 GROUP BY date_ecriture;

CREATE OR REPLACE VIEW v_couts_nature AS(
    SELECT DISTINCT date_ecriture, SUM(valeur_fixe) AS fixe, SUM(valeur_variable) AS variable FROM v_repartition_produit_compte_6 GROUP BY date_ecriture
);
