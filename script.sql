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
     adresse VARCHAR(35),
     telephone VARCHAR(10),
     mail VARCHAR(35)
);

CREATE TABLE IF NOT EXISTS identification_societe(
     societe INTEGER REFERENCES societe(id),
     nif VARCHAR(35) NOT NULL,
     scan_nif VARCHAR(35),
     ns VARCHAR(35) NOT NULL,
     scan_ns VARCHAR(35),
     nrcs VARCHAR(35) NOT NULL,
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

CREATE TABLE IF NOT EXISTS comptabilite(
     societe INTEGER REFERENCES societe(id),
     capital DECIMAL,
     devise INTEGER REFERENCES devise(id),
     date_debut_exercice DATE NOT NULL,
     date_fin_exercice DATE NOT NULL,
     devise_equivalence INTEGER REFERENCES devise_equivalence(id)
);


INSERT INTO type_societe(designation) VALUES('SA'), ('SARL'), ('EI'), ('SNC'), ('SCS'), ('SC'), ('GIE'), ('SDET'), ('EURL');

INSERT INTO devise(devise) VALUES('Ariary'), ('Euro'), ('Dollar');

INSERT INTO devise(devise) VALUES('Won'), ('Yen'), ('Mur');

INSERT INTO devise_equivalence(devise) VALUES('Ariary'), ('Euro'), ('Dollar'), ('Won'), ('Yen');

CREATE TABLE IF NOT EXISTS pcg2005(
    numero VARCHAR(5) PRIMARY KEY,
    designation VARCHAR(40)
);

INSERT INTO pcg2005(numero,designation) VALUES('10100', 'CAPITAL'),
                                            ('10610', 'RESERVE LEGALE'),
                                            ('10620', 'RESERVES STATUTAIRES'),
                                            ('11000', 'REPORT A NOUVEAU'),
                                            ('11010', 'REPORT A NOUVEAU SOLDE CREDITEUR'),
                                            ('11200', 'AUTRES PRODUITS ET CHARGES'),
                                            ('11900', 'REPORT A NOUVEAU SOLDE DEBITEUR'),
                                            ('12800', 'RESULTAT EN INSTANCE'),
                                            ('13100', 'SUBVENTION D"EQUIPEMENT'),
                                            ('13300', 'IMPOTS DIFFERES ACTIFS'),
                                            ('16110', 'EMPRUNT A LT'),
                                            ('16510', 'EMPRUNT A MOYEN TERME'),
                                            ('20124', 'FRAIS DE REHABILITATION'),
                                            ('20800', 'AUTRES IMMOB INCORPORELLES'),
                                            ('21100', 'TERRAINS'),
                                            ('21200', 'CONSTRUCTION'),
                                            ('21300', 'MATERIEL ET OUTILLAGE'),
                                            ('21510', 'MATERIEL AUTOMOBILE'),
                                            ('21520', 'MATERIEL MOTO'),
                                            ('21600', 'AGENCEMENT .AM .INST'),
                                            ('21810', 'MATERIELS ET MOBILIERS DE BUREAU'),
                                            ('21819', 'MATERIELS INFORMATIQUES ET AUTRES'),
                                            ('21820', 'MAT. MOB DE LOGEMENT'),
                                            ('21880', 'AUTRES IMMOBILISATIONS CORP'),
                                            ('23000', 'IMMOBILISATION EN COURS'),
                                            ('28000', 'AMORT IMMOB INCORP'),
                                            ('28120', 'AMORTISSEMENT DES CONSTRUCTIONS'),
                                            ('28130', 'AMORT MACH-MATER-OUTIL'),
                                            ('28150', 'AMORT MAT DE TRANSPORT'),
                                            ('28160', 'AMORT A.A.I'),
                                            ('28181', 'AMORT MATERIEL&MOB'),
                                            ('28182', 'AMORTISSEMNTS MATERIELS INFORMATIQUES'),
                                            ('28183', 'AMORT MATER & MOB LOGT'),
                                            ('32110', 'STOCK MATIERES PREMIERES'),
                                            ('32120', 'PETITRES FOURNITURES');
                                        
                                        
CREATE TABLE IF NOT EXISTS code_journal(
    id VARCHAR(10) PRIMARY KEY,
    designation VARCHAR(20)
);

INSERT INTO code_journal(id, designation) VALUES('AC', 'ACHAT'), 
                                                ('AN', 'A NOUVEAU'), 
                                                ('BN', 'BANQUE BNI'),
                                                ('BO', 'BANQUE BOA'),
                                                ('CA', 'CAISSE'),
                                                ('OD', 'OPERATIONS DIVERSES'),
                                                ('VE', 'VENTE EXPORT'),
                                                ('VL', 'VENTE LOCALE');

CREATE TABLE IF NOT EXISTS ecriture_journal(
    journal VARCHAR(10) REFERENCES code_journal(id),
    societe INTEGER REFERENCES societe(id),
    date_ecriture DATE,
    numero_piece VARCHAR(50) NOT NULL,
    compte_general VARCHAR(5) REFERENCES pcg2005(numero),
    compte_tiers VARCHAR(13),
    libelle VARCHAR(50),
    devise INTEGER,
    montant_devise DECIMAL,
    taux DECIMAL,
    debit DECIMAL,
    credit DECIMAL
);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0001', '60100', 'Achat 1', 560000);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, credit) VALUES('BN', 1, '2023-04-01', 'CQ0015', '53100', 'Sortie Banque', 500000);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('CA', 1, '2023-04-01', 'PC0001', '53100', 'Entrée Caisse', 500000);

INSERT INTO societe(nom,objet,date_creation, mot_de_passe) VALUES('DIMPEX','import-export Mada',now(),'individuel');

INSERT INTO comptabilite(societe, capital, devise, date_debut_exercice, date_fin_exercice, devise_equivalence) VALUES(1, 850000, 1, '2023-01-15', '2023-12-31', 2);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('CA', 1, '2023-04-03', 'PC0002', '53100', 'Entrée Caisse', 5000000);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, credit) VALUES('CA', 1, '2023-04-03', 'PC0003', '53100', 'Sortie Caisse', 250000);

/**CREATE TABLE tiers(
     id SERIAL primary key,
     numero VARCHAR(13),
     designation VARCHAR(40)
);**/

/**CREATE OR REPLACE VIEW compte_tiers AS
SELECT numero as num from pcg2005 where CAST(numero AS integer) BETWEEN 40100 AND 46000;**/

--------------------------------- 05-04-2023 ---------------------------------------------------

CREATE TYPE type_tiers AS ENUM('CL', 'FO');

CREATE TABLE tiers(
     id SERIAL PRIMARY KEY,
     type_tiers type_tiers, 
     numero VARCHAR(13) NOT NULL,
     designation VARCHAR(50)
);

INSERT INTO tiers(type_tiers, numero, designation) VALUES('FO', 'JIRAMA', 'FRNS: JIRAMA'),
                                                       ('FO', 'JOHN', 'FRNS: JOHN'),
                                                       ('CL', 'LAMBERT', 'CLT: LAMBERT'),
                                                       ('FO', 'LOVASOA', 'FRNS: LOVASOA'),
                                                       ('FO', 'MENDRIKA', 'FRNS: MENDRIKA'),
                                                       ('CL', 'NORO', 'CLT: NORO'),
                                                       ('FO', 'ORIMBATO', 'FRNS: ORIMBATO'),
                                                       ('FO', 'PAPANGO', 'FRNS: PAPANGO'),
                                                       ('CL', 'RABE', 'CLT: RABE'),
                                                       ('CL', 'RANDRIA', 'CLT: RANDRIA'),
                                                       ('FO', 'RAVINALA', 'FRNS: RAVINALA'),
                                                       ('CL', 'RIAKA', 'CLT: RIAKA'),
                                                       ('FO', 'RONDRO', 'FRNS: RONDRO'),
                                                       ('CL', 'SOLO', 'CLT: SOLO'),
                                                       ('FO', 'TELMA', 'FRNS: TELMA');


CREATE OR REPLACE VIEW v_balance AS
SELECT numero, designation, debit, credit, date_ecriture, societe from ecriture_journal JOIN pcg2005 ON compte_general = pcg2005.numero;

select numero, designation, sum(debit) as deb, sum(credit) as cred from v_balance group by numero, designation;


------------------------ 12-04-2023 ----------------------------------------------------------

CREATE TABLE IF NOT EXISTS taux_devise(
     devise INTEGER REFERENCES devise(id),
     taux DECIMAL DEFAULT 0,
     date_taux DATE DEFAULT NOW()
);

INSERT INTO taux_devise(devise, taux) VALUES(1, 15), (2, 10), (3, 15), (4, 5), (5, 10), (6, 5);

INSERT INTO taux_devise(devise, taux, date_taux) VALUES(1, 25, '2023-04-13');

select * from taux_devise 
join (select id as devise_id, devise as designation from devise) as devise on taux_devise.devise = devise.devise_id;

select taux_devise.*, devise.designation from taux_devise 
join (select id as devise_id, devise as designation from devise) as devise on taux_devise.devise = devise.devise_id;

CREATE OR REPLACE VIEW v_taux_devise AS(
     select taux_devise.*, devise.designation from taux_devise 
     join (select id as devise_id, devise as designation from devise) as devise on taux_devise.devise = devise.devise_id
);

SELECT * FROM v_taux_devise ORDER BY date_taux;

SELECT * FROM v_taux_devise WHERE date_taux = date(now()) OR date_taux >= date(now()) ORDER BY date_taux;

SELECT max(date_taux) as max_date FROM v_taux_devise;

SELECT DISTINCT ON (devise) * FROM v_taux_devise ORDER BY devise, date_taux DESC;

------------------------------- 18-04-2023 -----------------------------------------------------------



