create database feel_in_box;

\c feel_in_box

create table categorie(
    id varchar(20) primary key,
    nom varchar(100),
    created_at timestamp,
    updated_at timestamp 
);

create sequence categorie_seq 
start with 1
increment by 1;

create table taille(
    id serial primary key,
    nom varchar(20),
    created_at timestamp,
    updated_at timestamp
);

create table couleur(
    id serial primary key,
    nom varchar(20),
    created_at timestamp,
    updated_at timestamp
);

create table produits(
    id varchar(20) primary key,
    nom varchar(100),
    couleur int references couleur(id),
    taille int references taille(id),
    categorie varchar(20) references categorie(id),
    created_at timestamp,
    updated_at timestamp
);

create sequence produits_seq 
start with 1
increment by 1;

create table achat(
    id varchar(20) primary key,
    date date default now(),
    produits varchar(20) references produits(id),
    quantite int,
    prix_Unitaire double precision,
    created_at timestamp,
    updated_at timestamp
);

create sequence achat_seq 
start with 1
increment by 1;

create table produits_cout_vente(
    id varchar(20) primary key,
    date date,
    produits varchar(20) references produits(id),
    prix_vente double precision,
    code_barre varchar(50),
    created_at timestamp,
    updated_at timestamp
);

create sequence produits_couts_seq
start with 1
increment by 1;

create table vente(
    id varchar(20) primary key,
    produits_cout_vente varchar(20) references produits_cout_vente(id),
    date date,
    quantite int,
    created_at timestamp,
    updated_at timestamp
);

create table mouvements(
    id varchar(20) primary key,
    date date,
    achat varchar(20) references achat(id),
    vente varchar(20) references vente(id),
    created_at timestamp,
    updated_at timestamp
);

create sequence vente_seq 
start with 1
increment by 1;

create sequence mouvements_seq 
start with 1
increment by 1;

create table historique_achat(
    id serial primary key,
    achat varchar(20),
    produits varchar(20),
    date date,
    quantite int,
    created_at timestamp,
    updated_at timestamp
);

create table historique_vente(
    id serial primary key,
    vente varchar(20),
    produits varchar(20),
    date date,
    quantite int,
    created_at timestamp,
    updated_at timestamp
);

create table panier(
    id varchar(20) primary key,
    created_at timestamp,
    updated_at timestamp
);

create table panier_detail(
    id varchar(20) references panier(id),
    vente varchar(20) references vente(id),
    created_at timestamp,
    updated_at timestamp
);

create sequence panier_seq
start with 1
increment by 1;

create or replace view view_produits AS
select produits.id, produits.nom, couleur.nom as couleur, taille.nom as taille, categorie.nom as categorie , produits.created_at, produits.updated_at
from produits 
left join couleur on produits.couleur = couleur.id
left join taille on produits.taille = taille.id
left join categorie on produits.categorie = categorie.id;

create or replace view view_achat as 
select achat.id , achat.quantite, achat.prix_Unitaire, achat.montant_total, achat.date , produits.nom as produits_nom, produits.id as produits from achat
left join produits on achat.produits = produits.id;

create or replace view view_produits_cout_vente as
select produits_cout_vente.date, produits_cout_vente.id, produits_cout_vente.prix_vente , produits.nom, produits.id as produits ,produits_cout_vente.code_barre
from produits_cout_vente 
left join produits on produits_cout_vente.produits = produits.id;

CREATE OR REPLACE FUNCTION generate_custom_id(sequence_name text, prefix text, zero_padding int)
RETURNS text AS $$
BEGIN
    RETURN prefix || lpad(nextval(sequence_name)::text, zero_padding, '0');
END;
$$ LANGUAGE plpgsql;


-- reset sequence en entier 
DO $$ 
DECLARE 
    seq RECORD; 
BEGIN 
    FOR seq IN 
        SELECT sequence_schema, sequence_name 
        FROM information_schema.sequences 
        WHERE sequence_schema NOT IN ('pg_catalog', 'information_schema') 
    LOOP 
        EXECUTE format('ALTER SEQUENCE %I.%I RESTART WITH 1', seq.sequence_schema, seq.sequence_name); 
    END LOOP; 
END $$;
*
CREATE VIEW vue_mouvements_details AS
SELECT
    m.date,
    produits.nom AS nom_produit,
    a.id as achats,
    v.id as vente,
    a.quantite AS quantite_actuelle,
    v.quantite AS quantite_retirer,
    a.prix_unitaire AS prix_unitaire,
    p.prix_vente AS prix_vente,
    (v.quantite * p.prix_vente) AS montant_vente,
    ((p.prix_vente - a.prix_unitaire) * v.quantite) AS benefice
FROM
    mouvements m
JOIN
    achat a ON m.achat = a.id
JOIN
    vente v ON m.vente = v.id
JOIN
    produits_cout_vente p ON v.produits_cout_vente = p.id
JOIN
    produits on p.produits = produits.id;

create or replace view view_historique_achats as
select historique_achat.*, produits.nom from historique_achat
join produits on historique_achat.produits = produits.id;

create or replace view view_historique_vente as
select historique_vente.*, produits.nom from historique_vente
join produits on historique_vente.produits = produits.id;
