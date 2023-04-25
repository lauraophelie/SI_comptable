create or replace view solde as
SELECT DISTINCT numero,designation as libelle,societe, SUM(debit) as total_debit,SUM(credit) as total_credit,date_ecriture
FROM v_balance
GROUP BY numero,libelle,societe,date_ecriture
ORDER BY numero;
