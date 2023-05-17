------------------------------------ 09-05-2023 ----------------------------------------------------------------

-- table charge suppletif
CREATE TABLE charge_suppletif(
     id SERIAL PRIMARY KEY,
     id_produit INT REFERENCES produit(id),
     societe INT REFERENCES societe(id),
     designation VARCHAR(35),
     id_unite_oeuvre INT REFERENCES unite_oeuvre(id) NULL,
     categorie VARCHAR(15) DEFAULT 'INCORPORABLE'
);

create TABLE unite_oeuvre(
     id SERIAL PRIMARY KEY,
     designation VARCHAR(35) NOT NULL
);

create table ecriture_charge_suppletif(
     id SERIAL PRIMARY KEY,
     id_charge_suppletive INT REFERENCES charge_suppletif(id),
     nombre_unite_oeuvre INT NOT NULL,
     cout_unite_oeuvre DOUBLE PRECISION NOT NULL
     date_ecriture DATE NOT NULL,
     id_devise INT REFERENCES devise(id),
     variable DOUBLE PRECISION,
     fixe DOUBLE PRECISION
);

create type type_var as ENUM('variable','fixe'); 

create table details_ecriture_charge_suppletif(
     id_ecriture INT REFERENCES ecriture_charge_suppletif(id),
     variation type_var,
     id_centre INT REFERENCES centre(id),
     valeur_centre int not null
);

-- v_ecriture_charge
SELECT quantite, quantite, quantite*prix_unitaire as valeur, unite_oeuvre.designation, fixe, variable from ecriture_charge_suppletif
     JOIN unite_oeuvre ON id_unite_oeuvre = unite_oeuvre.id

-- v_details_ecriture_charge
SELECT * FROM details_ecriture_charge_suppletif
     JOIN centre ON id_centre = centre.id
     JOIN details_ecriture_charge_suppletif ON id_ecriture = ecriture_charge_suppletif.id
     

INSERT INTO charge_suppletif(societe, designation) 
     VALUES(1,'Heure supplémentaire DG');

-- INSERT INTO charge_suppletif(societe,designation) 
-- VALUES(%d,'%s',%d,'%s');

UPDATE charge_suppletif SET motif = '%s', valeur = %d, date_ecriture = '%s'  WHERE id = %d;

DELETE from charge_suppletif WHERE id = %d;

SELECT charge_suppletif.*, designation FROM charge_suppletif
     JOIN produit on id_produit = produit.id;

-- v_prix
SELECT charge_suppletif.designation as nom_charge, societe, id_charge_suppletive,valeur*prix_unitaire as valeur,variable, fixe, devise, date_ecriture from ecriture_charge_suppletif
     join unite_oeuvre on id_unite_oeuvre = unite_oeuvre.id
     join devise on id_devise = devise.id
     join charge_suppletif on id_charge_suppletive=charge_suppletif.id

-- req1
SELECT sum(valeur*variable) as cout_variable from v_prix
where date_ecriture > date_debut_exercice
AND societe = :societe

-- req2
SELECT sum(valeur*fixe) as cout_fixe from v_prix
where date_ecriture < date_debut_exercice
AND societe = :societe