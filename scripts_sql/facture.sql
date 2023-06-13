CREATE TABLE facture(
    id VARCHAR(15) NOT NULL,
    date_fact DATE NOT NULL,
    societe INT REFERENCES societe(id),
    tiers INT REFERENCES tiers(id),
    total_ttc DOUBLE PRECISION NOT NULL,
    tva DOUBLE PRECISION NOT NULL,
    reference VARCHAR(20),
    objet VARCHAR(20) NOT NULL,
    facture DOUBLE PRECISION NOT NULL,
    avance DOUBLE PRECISION DEFAULT 0,
    net_a_payer DOUBLE PRECISION NOT NULL
);

ALTER TABLE facture ADD CONSTRAINT ttc_positif CHECK (total_ttc > 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT tva_positif CHECK (tva > 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT payer_positif CHECK (net_a_payer >= 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT facture_positif CHECK (facture > 0) NOT VALID;

ALTER TABLE facture VALIDATE CONSTRAINT ttc_positif;
ALTER TABLE facture VALIDATE CONSTRAINT tva_positif;
ALTER TABLE facture VALIDATE CONSTRAINT payer_positif;
ALTER TABLE facture VALIDATE CONSTRAINT facture_positif;


CREATE TABLE gen_id_facture(
    societe INT REFERENCES societe(id),
    abreviation VARCHAR(3),
    date_fact DATE,
    last_index INT
);

CREATE TABLE details_facture(
    id SERIAL PRIMARY KEY,
    produit INT REFERENCES produit(id),
    quantite INT NOT NULL,
    prix_unitaire DOUBLE PRECISION NOT NULL,
    montant_ht INT NOT NULL,
    montant_ttc INT NOT NULL
);

