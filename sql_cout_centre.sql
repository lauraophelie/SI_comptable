insert into pcg2005(numero,designation) values ('60120',' Semences & plants'),
('60111','engrais & assimiles'),
('60260','emballages'),
('60680','Achats d autres matières et fournitures'),
('60610','Fournitures non stockables'),
('60620','carburants lubrifiants '),
('61320','locations mobilières et immobilières'),
('61500','Entretien et réparations'),
('61600','Primes d assurance'),
('60640','Fournitures administratives'),
('62600','Frais postaux et de télécommunications'),
('62260','Honoraires');

insert into pcg2005(numero,designation) values ('62410','Transports sur achat'),
('62510','Voyages et déplacements'),
('62560','missions'),
('62700','Services bancaires et assimilés'),
('62000','Les autres charges externes'),
('63000','Les impôts et taxes'),
('64110','Salaires et appointements'),
('64800','Autres charges de personnel'),
('68000','Dotations aux amortissements'),
('65000','Autres charges de gestion courante');

create table unite(
    unite VARCHAR(40) primary key
);

insert into unite(unite) values('KG'),('NB'),('Cons periodique'),('KW'),
('LITRES'),('Loyer mensuel'),('Heures de travail (HT)'),('Sal mens ou HT');

create table unite_compte_6(
    libelle VARCHAR(40),
    unite VARCHAR(40),
    foreign key(unite) references unite(unite)
);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0010', '60120', 'Achat semences', 4321600);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0011', '60111', 'Achat engrais et assimiles', 60000000);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0012', '60260', 'Achat d emballage', 7796400);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0013', '60610', 'eau et electicite', 34637200);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0014', '60620', 'GAZ,COMBUST,CARBURANT,LUBRIF', 35675400);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0015', '61320', 'location terrain', 9742000);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0016', '61500', 'ENTRETIENS ET REPARATIONS', 4987300);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0017', '61600', 'assurences', 5927200);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0018', '60680', 'Fournit magasin', 4446700);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0019', '60610', 'eau et electricite', 34637200);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0020', '60640', 'photocopie et assimiles', 450900);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0021', '62600', 'Envoi colis', 789500);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0022', '62260', 'honoraire', 8538100);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0023', '62410', 'Frais de transport', 3200000);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0024', '62510', 'Voyages et deplacement', 1934000);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0025', '62560', 'Missions(depl+hebrg+rest)', 16222500);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0026', '62700', 'Commissions banques', 31523800);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0027', '62000', 'Autres charges externes', 3142800);

INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0028', '63000', 'Impots et taxes', 5029800);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0029', '64110', 'Salaire permanents', 71735100);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0030', '64800', 'Autres charges du personnel', 15956700);
INSERT INTO ecriture_journal(journal, societe, date_ecriture, numero_piece, compte_general, libelle, debit) VALUES('AC', 1, '2023-04-01', 'AC0031', '65000', 'charges financieres', 23007600);


INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60120', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60111', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60260', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60610', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60620', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('61320', 100, 0, 1);

INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('61500', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('60640', 100, 0, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62600', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62260', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62410', 0, 100, 1);


INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62510', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62560', 100, 0, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62700', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('62000', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('63000', 100, 0, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('64110', 100, 0, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('64800', 0, 100, 1);
INSERT INTO pourcentage_compte_6(id_compte_6, fixe, variable, inc) VALUES('65000', 0, 100, 1);