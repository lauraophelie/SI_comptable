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

INSERT INTO facture VALUES('DMP/06/2023/001',NOW(),1,2,200000,40000,'','vente',240000,40000,200000);
INSERT INTO facture VALUES('DMP/06/2023/002',NOW(),1,3,150000,30000,'','vente',450000,0,450000);
INSERT INTO facture VALUES('DMP/06/2023/003',NOW(),1,1,500000,100000,'','vente',600000,100000,500000);


ALTER TABLE facture ADD CONSTRAINT ttc_positif CHECK (total_ttc > 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT tva_positif CHECK (tva > 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT payer_positif CHECK (net_a_payer >= 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT facture_positif CHECK (facture > 0) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT facture_ok CHECK (total_ttc + tva = facture) NOT VALID;
ALTER TABLE facture ADD CONSTRAINT payer_ok CHECK (facture - avance = net_a_payer) NOT VALID;


ALTER TABLE facture VALIDATE CONSTRAINT ttc_positif;
ALTER TABLE facture VALIDATE CONSTRAINT tva_positif;
ALTER TABLE facture VALIDATE CONSTRAINT payer_positif;
ALTER TABLE facture VALIDATE CONSTRAINT facture_positif;
ALTER TABLE facture VALIDATE CONSTRAINT facture_ok;
ALTER TABLE facture VALIDATE CONSTRAINT payer_ok;

CREATE TABLE gen_id_facture(
    societe INT REFERENCES societe(id),
    abreviation VARCHAR(3),
    date_fact DATE,
    last_index INT DEFAULT 0
); 

INSERT INTO gen_id_facture(societe,abreviation,date_fact) VALUES(1,'DMP',NOW());

CREATE TABLE details_facture(
    id SERIAL PRIMARY KEY,
    produit INT REFERENCES produit(id),
    quantite INT NOT NULL,
    prix_unitaire DOUBLE PRECISION NOT NULL,
    montant_ht INT NOT NULL,
    montant_ttc INT NOT NULL
);

CREATE OR REPLACE VIEW v_infos_tiers AS
SELECT tiers_id as id_tiers, nom_societe as nom_tiers, adresse as adresse_tiers, mail as mail_tiers, telephone as telephone_tiers FROM v_tiers; 

CREATE OR REPLACE VIEW v_facture AS
SELECT facture.*,nom,adresse,telephone,nom_tiers, adresse_tiers, mail_tiers from facture
join v_infos_societe on v_infos_societe.id = facture.societe
join v_infos_tiers on v_infos_tiers.id_tiers = facture.tiers;

ALTER TABLE facture ADD CONSTRAINT set_id PRIMARY KEY(id) ;

ALTER TABLE details_facture ADD COLUMN idfacture VARCHAR REFERENCES facture(id);

CREATE OR REPLACE VIEW v_details AS
SELECT details_facture.id, idfacture, produit as idproduit, quantite, montant_ht,montant_ttc, designation as nom_produit, details_facture.prix_unitaire, unite_oeuvre
 FROM details_facture join produit on produit.id= details_facture.produit;

CREATE OR REPLACE VIEW v_details_facture AS
SELECT * FROM v_details JOIN unite_oeuvre on v_details.unite_oeuvre = unite_oeuvre.designation