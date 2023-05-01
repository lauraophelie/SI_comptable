create or replace view solde as
SELECT DISTINCT numero,designation as libelle,societe, SUM(debit) as total_debit,SUM(credit) as total_credit,date_ecriture
FROM v_balance
GROUP BY numero,libelle,societe,date_ecriture
ORDER BY numero;

------------------------01/04/2023---------------------------------
create table produit(
    id serial primary key,
    designation VARCHAR(50)
);

insert into produit(designation) values('mais'),('manioc'),('riz'),('fromage'),('chocolat'),('Yaourt'),('carottes'),('lait');