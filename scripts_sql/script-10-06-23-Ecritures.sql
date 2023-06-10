-------------------------------------------------------- 10-06-2023 -----------------------------------------------------------

CREATE TABLE IF NOT EXISTS ecriture_charges(
    id SERIAL,
    societe INTEGER REFERENCES societe(id),
    date_ecriture DATE,
    numero_piece VARCHAR(50) NOT NULL,
    compte_general VARCHAR(5) REFERENCES pcg2005(numero),
    libelle VARCHAR(50),
    unite_oeuvre INTEGER REFERENCES unite_oeuvre(id),
    quantite DECIMAL DEFAULT 0,
    montant DECIMAL DEFAULT 0
);

ALTER TABLE ecriture_charges ADD CONSTRAINT check_compte CHECK (compte_general LIKE '6%');

SELECT * FROM ecriture_charges e
JOIN pcg2005 AS p ON e.compte_general = p.numero
JOIN unite_oeuvre u ON e.unite_oeuvre = u.id;

SELECT 
    e.id as num, e.id, e.societe, e.date_ecriture, e.numero_piece, e.compte_general as numero_compte, p.designation as compte, e.libelle, u.designation as unite_oeuvre, e.quantite, e.montant
FROM ecriture_charges e
JOIN pcg2005 AS p ON e.compte_general = p.numero
JOIN unite_oeuvre u ON e.unite_oeuvre = u.id;

CREATE OR REPLACE VIEW v_ecritures_charges AS(
    SELECT 
        e.id as num, e.societe, e.date_ecriture, e.numero_piece, e.compte_general as numero_compte, 
        p.designation as compte, e.libelle, u.designation as unite_oeuvre, e.quantite, e.montant
    FROM ecriture_charges e
    JOIN pcg2005 AS p ON e.compte_general = p.numero
    JOIN unite_oeuvre u ON e.unite_oeuvre = u.id
);