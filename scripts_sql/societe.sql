CREATE TABLE IF NOT EXISTS type_societe(
     id SERIAL PRIMARY KEY,
     designation VARCHAR(10)
);

CREATE TABLE IF NOT EXISTS societe(
     id SERIAL PRIMARY KEY,
     nom VARCHAR(12) NOT NULL,
     logo VARCHAR(35),
     objet VARCHAR(35) NOT NULL,
     date_creation DATE NOT NULL,
     dirigeant VARCHAR(35),
     employe INTEGER DEFAULT 1,
     mot_de_passe VARCHAR(10) NOT NULL
);

ALTER TABLE societe ADD CONSTRAINT check_min_length CHECK (length(nom) >= 5);

CREATE TABLE IF NOT EXISTS adresses_societe(
     societe INTEGER REFERENCES societe(id),
     siege VARCHAR(35),
     adresse VARCHAR(90),
     telephone VARCHAR(10),
     telecopie VARCHAR(10),
     mail VARCHAR(35)
); 

-- niova
CREATE TABLE IF NOT EXISTS identification_societe(
     societe INTEGER REFERENCES societe(id),
     nif VARCHAR(35),
     scan_nif VARCHAR(35),
     ns VARCHAR(35),
     scan_ns VARCHAR(35),
     nrcs VARCHAR(35),
     scan_nrcs VARCHAR(35)
);

CREATE TABLE IF NOT EXISTS devise_equivalence(
     id SERIAL PRIMARY KEY,
     devise VARCHAR(35) NOT NULL,
     valeur DECIMAL
);

CREATE TABLE IF NOT EXISTS devise(
     id SERIAL PRIMARY KEY,
     devise VARCHAR(35)
);

-- niova
CREATE TABLE IF NOT EXISTS comptabilite(
     societe INTEGER REFERENCES societe(id) NOT NULL,
     capital DECIMAL NOT NULL,
     devise INTEGER REFERENCES devise(id) DEFAULT 1,
     date_debut_exercice DATE NOT NULL,
     date_fin_exercice DATE,
     devise_equivalence INTEGER REFERENCES devise_equivalence(id)
);

-- niampy
INSERT INTO adresses_societe(societe) VALUES(1);
INSERT INTO identification_societe(societe) VALUES(1);
--

INSERT INTO comptabilite(societe,capital, date_debut_exercice) VALUES(1,850000,'2022-01-31');

INSERT INTO type_societe(designation) VALUES('SA'), ('SARL'), ('EI'), ('SNC'), ('SCS'), ('SC'), ('GIE'), ('SDET'), ('EURL');

INSERT INTO devise(devise) VALUES('Ariary'), ('Euro'), ('Dollar');

INSERT INTO devise(devise) VALUES('Won'), ('Yen'), ('Mur');

INSERT INTO devise_equivalence(devise) VALUES('Ariary'), ('Euro'), ('Dollar'), ('Won'), ('Yen');

-- v_infos_societe


CREATE OR REPLACE VIEW v_infos_societe AS 
SELECT nom, adresse, telephone, mail FROM societe 
JOIN adresses_societe ON societe.id = adresses_societe.societe; 

-- info générale société


CREATE OR REPLACE VIEW v_infos_general AS
SELECT adresses_societe.*, nif,scan_nif,ns,scan_ns,nrcs,scan_nrcs, capital, date_debut_exercice as date_debut, devise.devise as nom_devise, comptabilite.devise as id_devise, nom, logo, objet, date_creation, dirigeant, employe, mot_de_passe as mdp  FROM societe
JOIN adresses_societe ON societe.id = adresses_societe.societe
JOIN identification_societe ON societe.id = identification_societe.societe
JOIN comptabilite ON societe.id = comptabilite.societe
JOIN devise ON comptabilite.devise = devise.id;

