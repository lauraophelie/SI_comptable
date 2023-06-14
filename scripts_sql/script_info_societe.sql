UPDATE societe SET mot_de_passe='individuel' WHERE id=1;

INSERT INTO adresses_societe(societe, adresse, telephone, telecopie) VALUES
                            (1, 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', '22 770 99', '22 230 66');

UPDATE comptabilite SET devise=1 WHERE societe=1;

SELECT
    s.id AS id,
    s.nom AS societe,
    a.adresse AS adresse,
    a.telephone AS telephone,
    a.telecopie AS telecopie,
    d.devise AS devise
FROM societe s
JOIN adresses_societe a ON s.id = a.societe
JOIN comptabilite c ON s.id = c.societe
JOIN devise d ON c.devise = d.id;

CREATE OR REPLACE VIEW v_infos_societe AS(
    SELECT
        s.id AS id,
        s.nom AS societe,
        a.adresse AS adresse,
        a.telephone AS telephone,
        a.telecopie AS telecopie,
        d.devise AS devise
    FROM societe s
    JOIN adresses_societe a ON s.id = a.societe
    JOIN comptabilite c ON s.id = c.societe
    JOIN devise d ON c.devise = d.id
);

SELECT DISTINCT(societe), SUM(credit) AS capital FROM ecriture_journal WHERE compte_general = '10100' GROUP BY societe;

SELECT societe, date_ecriture, credit AS capital FROM ecriture_journal WHERE compte_general = '10100' ORDER BY societe, date_ecriture;

