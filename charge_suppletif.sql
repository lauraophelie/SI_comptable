------------------------------------ 09-05-2023 ----------------------------------------------------------------

-- table charge suppletif
CREATE TABLE charge_suppletif(
     id SERIAL PRIMARY KEY,
     id_produit INT REFERENCES produit(id),
     societe INT REFERENCES societe(id),
     designation VARCHAR(35),
     categorie VARCHAR(15) DEFAULT 'INCORPORABLE'
);

create TABLE unite_oeuvre(
     id SERIAL PRIMARY KEY,
     designation VARCHAR(35) NOT NULL,
     prix_unitaire DOUBLE PRECISION NOT NULL 
);

create table ecriture_charge_suppletif(
     id SERIAL PRIMARY KEY,
     id_charge_suppletive INT REFERENCES charge_suppletif(id),
     valeur DOUBLE PRECISION NOT NULL,
     id_unite_oeuvre INT REFERENCES unite_oeuvre(id),
     date_ecriture DATE NOT NULL,
     devise INT REFERENCES devise(id),
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

SELECT * from ecriture_charge_suppletif
     JOIN details_ecriture_charge_suppletif ON id_ecriture = ecriture_charge_suppletif.id
     JOIN centre ON id_centre = centre.id

INSERT INTO charge_suppletif(societe, designation) 
     VALUES(1,'Heure supplémentaire DG');

-- INSERT INTO charge_suppletif(societe,designation) 
-- VALUES(%d,'%s',%d,'%s');

UPDATE charge_suppletif SET motif = '%s', valeur = %d, date_ecriture = '%s'  WHERE id = %d;

DELETE from charge_suppletif WHERE id = %d;

SELECT charge_suppletif.*, designation FROM charge_suppletif
     JOIN produit on id_produit = produit.id;