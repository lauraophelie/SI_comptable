ALTER TABLE tiers ADD COLUMN societe int DEFAULT 0;

ALTER TABLE societe
DROP CONSTRAINT check_min_length;

INSERT INTO societe(nom, objet, date_creation, mot_de_passe) VALUES
                    ('JIRAMA', 'import-export Mada', now(), 'jirama'), 
                    ('JOHN', 'import-export Mada', now(), 'john'),
                    ('LAMBERT', 'import-export Mada', now(), 'lambert'),
                    ('LOVASOA', 'import-export Mada', now(), 'lovasoa'),
                    ('MENDRIKA','import-export Mada',now(),'mendrika'),
                    ('NORO', 'import-export Mada', now(), 'noro'),
                    ('ORIMBATO', 'import-export Mada', now(), 'orimbato'),
                    ('PAPANGO', 'import-export Mada', now(), 'papango'),
                    ('RABE', 'import-export Mada', now(), 'rabe'),
                    ('RANDRIA', 'import-export Mada', now(), 'randria'),
                    ('RAVINALA', 'import-export Mada', now(), 'ravinala'),
                    ('RIAKA', 'import-export Mada', now(), 'riaka'),
                    ('RONDRO', 'import-export Mada', now(), 'rondro'),
                    ('SOLO', 'import-export Mada', now(), 'solo'),
                    ('TELMA', 'import-export Mada', now(), 'telma');

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

CREATE OR REPLACE VIEW v_tiers AS (
    SELECT * FROM tiers
    JOIN adresses_societe ON tiers.societe = adresses_societe.societe
    JOIN societe ON tiers.societe = societe.id
)

CREATE OR REPLACE VIEW v_tiers AS(
    SELECT 
        tiers.id AS tiers_id, tiers.type_tiers, tiers.numero, tiers.designation,
        societe.id AS societe_id, societe.nom AS societe,
        societe.objet, societe.date_creation, societe.dirigeant,
        adresses_societe.siege, adresses_societe.adresse, adresses_societe.telephone,
        adresses_societe.mail
    FROM tiers
    JOIN adresses_societe ON tiers.societe = adresses_societe.societe
    JOIN societe ON tiers.societe = societe.id
);

-- --------------------------PRODUIT-------------------------------------
ALTER TABLE produit ADD COLUMN prix_unitaire DECIMAL;
-- ALTER TABLE produit ADD COLUMN unite_oeuvre VARCHAR(20);

-------------------------------- 11-06-2023 -----------------------------------------------------

INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(2, 'LOT SA56 ANALAKELY ANTANANARIVO 101', '0334521545', 'jirama@gmail.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(3, 'LOT SZ345 ANKORONDRANO ANTANANARIVO 101', '0123456789', 'john@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(4, 'LOT BP 205 IVANDRY ANTANANARIVO 101', '0234567890', 'lambert@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(5, 'LOT BP 345 ANALAMAHITSY ANTANANARIVO 101', '0345678901', 'lovasoa@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(6, 'LOT BP 360 ANOSY ANTANANARIVO 101', '0456789012', 'mendrika@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(7, 'LOT BP 360 ANDOHARANOFOTSY ANTANANARIVO 101', '0567890123', 'noro@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(8, 'LOT BP 456 MAHAMASINA ANTANANARIVO 101', '0678901234', 'orimbato@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(9, 'LOT BP 1900 TANJOMBATO ANTANANARIVO 101', '0789012345', 'papango@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(10, 'LOT BP 1234 ANALAKELY ANTANANARIVO 101', '0890123456', 'rabe@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(11, 'LOT BP 12345 BEHORIRIKA ANTANANARIVO 101', '0901234567', 'randria@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(12, 'LOT BP 456 IVANDRY ANTANANARIVO 101', '0912345678', 'ravinala@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(13, 'LOT BP 34567 ANALAKELY ANTANANARIVO 101', '0923456789', 'riaka@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(14, 'LOT BP 7896 BEHORIRIKA ANTANANARIVO 101', '0934567890', 'rondro@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(15, 'LOT BP 14662 ANKORONDRANO ANTANANARIVO 101', '0945678901', 'solo@example.com');
INSERT INTO adresses_societe(societe, adresse, telephone, mail) VALUES(16, 'LOT BP 2500 IVANDRY ANTANANARIVO 101', '0956789012', 'telma@example.com');

ALTER TABLE produit ADD COLUMN unite_oeuvre INTEGER;

UPDATE produit SET prix_unitaire=2000, unite_oeuvre=1 WHERE id=1;

SELECT * FROM produit p
JOIN unite_oeuvre AS uo ON  p.id = uo.id;

SELECT
    p.id, p.designation, p.prix_unitaire, uo.designation as unite
FROM produit p
JOIN unite_oeuvre AS uo ON  p.id = uo.id;

CREATE OR REPLACE VIEW v_produits AS(
    SELECT
        p.id, p.designation, p.prix_unitaire, uo.designation as unite
    FROM produit p
    JOIN unite_oeuvre AS uo ON  p.id = uo.id
);