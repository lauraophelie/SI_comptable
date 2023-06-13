-- --------------------------TIERS-------------------------------------

ALTER TABLE tiers ADD COLUMN societe int DEFAULT 0;

ALTER TABLE societe
DROP CONSTRAINT check_min_length;

ALTER TABLE societe ALTER COLUMN objet DROP NOT NULL;
ALTER TABLE societe ALTER COLUMN date_creation DROP NOT NULL;
ALTER TABLE societe ALTER COLUMN mot_de_passe DROP NOT NULL;

insert into societe(nom,objet,date_creation,mot_de_passe) values
                    ('JIRAMA','import-export Mada',now(),'jirama'), 
                    ('JOHN','import-export Mada',now(),'john'),
                    ('LAMBERT','import-export Mada',now(),'lambert'),
                    ('LOVASOA','import-export Mada',now(),'lovasoa'),
                    ('MENDRIKA','import-export Mada',now(),'mendrika'),
                    ('NORO','import-export Mada',now(),'noro'),
                    ('ORIMBATO','import-export Mada',now(),'orimbato'),
                    ('PAPANGO','import-export Mada',now(),'papango'),
                    ('RABE','import-export Mada',now(),'rabe'),
                    ('RANDRIA','import-export Mada',now(),'randria'),
                    ('RAVINALA','import-export Mada',now(),'ravinala'),
                    ('RIAKA','import-export Mada',now(),'riaka'),
                    ('RONDRO','import-export Mada',now(),'rondro'),
                    ('SOLO','import-export Mada',now(),'solo'),
                    ('TELMA','import-export Mada',now(),'telma');

UPDATE tiers set societe=2 where numero='JIRAMA';
UPDATE tiers set societe=3 where numero='JOHN';
UPDATE tiers set societe=4 where numero='LAMBERT';
UPDATE tiers set societe=5 where numero='LOVASOA';
UPDATE tiers set societe=6 where numero='MENDRIKA';
UPDATE tiers set societe=7 where numero='NORO';
UPDATE tiers set societe=8 where numero='ORIMBATO';
UPDATE tiers set societe=9 where numero='PAPANGO';
UPDATE tiers set societe=10 where numero='RABE';
UPDATE tiers set societe=11 where numero='RANDRIA';
UPDATE tiers set societe=12 where numero='RAVINALA';
UPDATE tiers set societe=13 where numero='RIAKA';
UPDATE tiers set societe=14 where numero='RONDRO';
UPDATE tiers set societe=15 where numero='SOLO';
UPDATE tiers set societe=16 where numero='TELMA';

ALTER TABLE tiers
ADD CONSTRAINT foreign_key
FOREIGN KEY (societe)
REFERENCES societe (id);

CREATE OR REPLACE VIEW v_tiers AS 
SELECT * FROM tiers
JOIN adresses_societe ON tiers.societe = adresses_societe.societe
JOIN societe ON tiers.societe = societe.id;


CREATE OR REPLACE VIEW v_tiers AS
SELECT tiers.id AS tiers_id, tiers.type_tiers, tiers.numero, tiers.designation,
    tiers.societe AS tiers_societe, 
    adresses_societe.siege, adresses_societe.adresse, adresses_societe.telephone,
    adresses_societe.mail,
    societe.id AS societe_id, societe.nom AS nom_societe, societe.logo,
    societe.objet, societe.date_creation, societe.dirigeant,
    societe.employe, societe.mot_de_passe
FROM tiers
JOIN adresses_societe ON tiers.societe = adresses_societe.societe
JOIN societe ON tiers.societe = societe.id;

-- --------------------------PRODUIT-------------------------------------
ALTER TABLE produit ADD COLUMN prix_unitaire DECIMAL;
ALTER TABLE produit ADD COLUMN unite_oeuvre VARCHAR(20);

ALTER TABLE produit ALTER COLUMN unite_oeuvre TYPE integer USING unite_oeuvre::integer;

ALTER TABLE produit ADD CONSTRAINT foreignkey FOREIGN KEY (unite_oeuvre) REFERENCES unite_oeuvre(id);

-- --------------------------TVA-------------------------------------
create table TVA(
    TVA float
);
insert into TVA values(20);

