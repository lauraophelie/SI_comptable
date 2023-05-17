------------------------------------ 09-05-2023 ----------------------------------------------------------------

-- table charge suppletive
CREATE TABLE charge_suppletive(
     id SERIAL PRIMARY KEY,
     id_produit INT REFERENCES produit(id),
     societe INT REFERENCES societe(id),
     designation VARCHAR(35),
     id_unite_oeuvre INT REFERENCES unite_oeuvre(id) NULL
);

create TABLE unite_oeuvre(
     id SERIAL PRIMARY KEY,
     designation VARCHAR(35) NOT NULL
);

create table ecriture_charge_suppletive(
     id SERIAL PRIMARY KEY,
     id_charge_suppletive INT REFERENCES charge_suppletive(id),
     nombre_unite_oeuvre INT NOT NULL,
     cout_unite_oeuvre DOUBLE PRECISION NOT NULL
     date_ecriture DATE NOT NULL,
     id_devise INT REFERENCES devise(id),
     variable DOUBLE PRECISION,
     fixe DOUBLE PRECISION
);

create type type_var as ENUM('variable','fixe'); 

create table details_ecriture_charge_suppletive(
     id_ecriture INT REFERENCES ecriture_charge_suppletive(id),
     variation type_var,
     id_centre INT REFERENCES centre(id),
     valeur_centre int not null
);

-- v_ecriture_charge
SELECT quantite, quantite*prix_unitaire as valeur, unite_oeuvre.designation, fixe, variable from ecriture_charge_suppletive
     JOIN unite_oeuvre ON id_unite_oeuvre = unite_oeuvre.id

-- v_details_ecriture_charge
SELECT * FROM details_ecriture_charge_suppletive
     JOIN centre ON id_centre = centre.id
     JOIN details_ecriture_charge_suppletive ON id_ecriture = ecriture_charge_suppletive.id
     

INSERT INTO charge_suppletive(societe, designation) 
     VALUES(1,'Heure supplémentaire DG');

-- INSERT INTO charge_suppletive(societe,designation) 
-- VALUES(%d,'%s',%d,'%s');

UPDATE charge_suppletive SET motif = '%s', valeur = %d, date_ecriture = '%s'  WHERE id = %d;

DELETE from charge_suppletive WHERE id = %d;

SELECT charge_suppletive.*, designation FROM charge_suppletive
     JOIN produit on id_produit = produit.id;

-- v_prix_suppletive
SELECT charge_suppletive.designation as nom_charge, societe, id_charge_suppletive,nombre_unite_oeuvre*cout_unitaire_oeuvre as valeur,variable, fixe, devise, date_ecriture, id_produit from ecriture_charge_suppletive
     join unite_oeuvre on id_unite_oeuvre = unite_oeuvre.id
     join devise on id_devise = devise.id
     join charge_suppletive on id_charge_suppletive=charge_suppletive.id

-- req1
SELECT sum(valeur*variable) as cout_variable from v_prix_suppletive
where date_ecriture > :debut_exercice
AND societe = :societe
AND id_produit = :produit

-- req2
SELECT sum(valeur*fixe) as cout_fixe from v_prix
where date_ecriture < date_debut_exercice
AND societe = :societe
AND id_produit = :produit