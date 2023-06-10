CREATE TABLE IF NOT EXISTS ecriture_charges(
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

