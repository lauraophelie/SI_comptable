------------------------------------ 09-05-2023 ----------------------------------------------------------------

create TABLE unite_oeuvre(
     id SERIAL PRIMARY KEY,
     designation VARCHAR(35) NOT NULL
);

create type type_var as ENUM('variable','fixe'); 

-- table charge suppletive
CREATE TABLE charge_suppletive(
     id SERIAL PRIMARY KEY,
     societe INT REFERENCES societe(id),
     designation VARCHAR(35),
     id_unite_oeuvre INT REFERENCES unite_oeuvre(id) NULL
);

create table ecriture_charge_suppletive(
     id SERIAL PRIMARY KEY,
     id_charge_suppletive INT REFERENCES charge_suppletive(id),
     nombre_unite_oeuvre INT NOT NULL,
     cout_unite_oeuvre DOUBLE PRECISION NOT NULL,
     date_ecriture DATE NOT NULL,
     id_devise INT REFERENCES devise(id)
);
     
-- ecs = ecriture charge suppletive
create table details_ecs_produit(
     id SERIAL PRIMARY KEY,
     id_ecriture INT REFERENCES ecriture_charge_suppletive(id),
     id_produit INT REFERENCES produit(id),
     cle_repartition DOUBLE PRECISION NOT NULL,
     variable DOUBLE PRECISION NOT NULL,
     fixe DOUBLE PRECISION NOT NULL
);

create table details_ecs_produit_centre(
     id SERIAL PRIMARY KEY,
     id_ecsp INT REFERENCES details_ecs_produit(id),
     variation type_var,
     id_centre INT REFERENCES centre(id),
     valeur_centre int not null
);

-- v_ecriture_charge

--SELECT quantite, quantite*prix_unitaire as valeur, unite_oeuvre.designation, fixe, variable from ecriture_charge_suppletive
     --JOIN unite_oeuvre ON id_unite_oeuvre = unite_oeuvre.id


-- v_ecriture_suppletive
CREATE OR REPLACE VIEW v_ecriture_suppletive AS 
SELECT id_charge_suppletive,charge_suppletive.designation as nom_charge, nombre_unite_oeuvre as quantite, nombre_unite_oeuvre * cout_unite_oeuvre as valeur, unite_oeuvre.designation  as unite, cle_repartition, id_produit, variable, fixe
from ecriture_charge_suppletive 
join details_ecs_produit on details_ecs_produit.id_ecriture = ecriture_charge_suppletive.id
join charge_suppletive on id_charge_suppletive= charge_suppletive.id
JOIN unite_oeuvre ON id_unite_oeuvre = unite_oeuvre.id


-- v_details_charge_suppl_produit
CREATE OR REPLACE VIEW AS v_details_charge_suppl_produit AS
SELECT ecriture_charge_suppletive.id as id_ecriture, nombre_unite_oeuvre*cout_unitaire_oeuvre as valeur_oeuvre, date_ecriture,  FROM ecriture_charge_suppletive
     JOIN details_ecs_produit ON id_ecriture = ecriture_charge_suppletive.id;

INSERT INTO charge_suppletive(societe, designation) 
     VALUES(1,'Heure supplémentaire DG');

-- INSERT INTO charge_suppletive(societe,designation) 
-- VALUES(%d,'%s',%d,'%s');

UPDATE charge_suppletive SET motif = '%s', valeur = %d, date_ecriture = '%s'  WHERE id = %d;

DELETE from charge_suppletive WHERE id = %d;

SELECT charge_suppletive.*, designation FROM charge_suppletive
     JOIN details_ecriture_charge_suppletive on details_ecriture_charge_suppletive.id_charge_suppletive = charge_suppletive.id
     JOIN produit on id_produit = produit.id;

CREATE OR REPLACE v_prix_suppletive AS
SELECT charge_suppletive.designation as nom_charge, societe, id_charge_suppletive,nombre_unite_oeuvre*cout_unitaire_oeuvre as valeur,variable, fixe, devise, date_ecriture, id_produit from ecriture_charge_suppletive
     join unite_oeuvre on id_unite_oeuvre = unite_oeuvre.id
     join devise on id_devise = devise.id
     join charge_suppletive on id_charge_suppletive=charge_suppletive.id

-- req1
SELECT sum(valeur*variable) as cout_variable, sum(valeur*fixe) as cout_fixe from v_prix_suppletive
where date_ecriture > :debut_exercice
AND societe = :societe
AND id_produit = :produit

-- req2
SELECT sum(valeur*variable) as cout_variable, sum(valeur*fixe) as cout_fixe from v_prix
where date_ecriture < date_debut_exercice
AND societe = :societe
AND id_produit = :produit