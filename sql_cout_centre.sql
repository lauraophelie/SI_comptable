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