create or replace view solde as
SELECT DISTINCT numero,designation as libelle,societe, SUM(debit) as total_debit,SUM(credit) as total_credit
FROM v_balance
GROUP BY numero,libelle,societe
ORDER BY numero;