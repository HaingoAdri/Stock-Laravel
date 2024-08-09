\c feel_in_box

-- Insertion des catégories
INSERT INTO categorie (id, nom, created_at, updated_at)
VALUES 
('CAT01', 'Vêtements', NOW(), NOW()),
('CAT02', 'Chaussures', NOW(), NOW()),
('CAT03', 'Accessoires', NOW(), NOW()),
('CAT04', 'Sacs', NOW(), NOW()),
('CAT05', 'Chapeaux', NOW(), NOW()),
('CAT06', 'Montres', NOW(), NOW()),
('CAT07', 'Bijoux', NOW(), NOW()),
('CAT08', 'Ceintures', NOW(), NOW()),
('CAT09', 'Lunettes', NOW(), NOW()),
('CAT10', 'Gants', NOW(), NOW());

-- Insertion des tailles
INSERT INTO taille (nom, created_at, updated_at)
VALUES 
('XS', NOW(), NOW()),
('S', NOW(), NOW()),
('M', NOW(), NOW()),
('L', NOW(), NOW()),
('XL', NOW(), NOW()),
('XXL', NOW(), NOW()),
('XXXL', NOW(), NOW()),
('4XL', NOW(), NOW()),
('5XL', NOW(), NOW()),
('6XL', NOW(), NOW());

-- Insertion des couleurs
INSERT INTO couleur (nom, created_at, updated_at)
VALUES 
('Rouge', NOW(), NOW()),
('Bleu', NOW(), NOW()),
('Vert', NOW(), NOW()),
('Jaune', NOW(), NOW()),
('Noir', NOW(), NOW()),
('Blanc', NOW(), NOW()),
('Gris', NOW(), NOW()),
('Rose', NOW(), NOW()),
('Orange', NOW(), NOW()),
('Violet', NOW(), NOW());

-- Insertion des produits
INSERT INTO produits (id, nom, couleur, taille, categorie, created_at, updated_at)
VALUES 
('P001', 'T-Shirt Rouge', 1, 2, 'CAT01', NOW(), NOW()),
('P002', 'Pantalon Bleu', 2, 3, 'CAT01', NOW(), NOW()),
('P003', 'Casquette Verte', 3, 1, 'CAT03', NOW(), NOW()),
('P004', 'Chapeau Jaune', 4, 2, 'CAT05', NOW(), NOW()),
('P005', 'Montre Noire', 5, 1, 'CAT06', NOW(), NOW()),
('P006', 'Bijou Blanc', 6, 4, 'CAT07', NOW(), NOW()),
('P007', 'Ceinture Grise', 7, 3, 'CAT08', NOW(), NOW()),
('P008', 'Lunettes Roses', 8, 5, 'CAT09', NOW(), NOW()),
('P009', 'Gants Orange', 9, 2, 'CAT10', NOW(), NOW()),
('P010', 'Sac Violet', 10, 1, 'CAT04', NOW(), NOW());

-- Insertion des achats
INSERT INTO achat (id, date, produits, quantite, prix_Unitaire, created_at, updated_at)
VALUES 
('A001', '2024-07-01', 'P001', 10, 15.50, NOW(), NOW()),
('A002', '2024-07-02', 'P002', 5, 30.00, NOW(), NOW()),
('A003', '2024-07-03', 'P003', 20, 7.25, NOW(), NOW()),
('A004', '2024-07-04', 'P004', 15, 25.00, NOW(), NOW()),
('A005', '2024-07-05', 'P005', 7, 50.00, NOW(), NOW()),
('A006', '2024-07-06', 'P006', 12, 100.00, NOW(), NOW()),
('A007', '2024-07-07', 'P007', 9, 18.75, NOW(), NOW()),
('A008', '2024-07-08', 'P008', 14, 60.00, NOW(), NOW()),
('A009', '2024-07-09', 'P009', 8, 35.00, NOW(), NOW()),
('A010', '2024-07-10', 'P010', 11, 45.00, NOW(), NOW());

-- Insertion des prix de vente des produits
INSERT INTO produits_cout_vente (date, achat, prix_vente, created_at, updated_at)
VALUES 
('2024-07-05', 'A001', 20.00, NOW(), NOW()),
('2024-07-06', 'A002', 40.00, NOW(), NOW()),
('2024-07-07', 'A003', 10.00, NOW(), NOW()),
('2024-07-08', 'A004', 35.00, NOW(), NOW()),
('2024-07-09', 'A005', 70.00, NOW(), NOW()),
('2024-07-10', 'A006', 150.00, NOW(), NOW()),
('2024-07-11', 'A007', 25.00, NOW(), NOW()),
('2024-07-12', 'A008', 90.00, NOW(), NOW()),
('2024-07-13', 'A009', 55.00, NOW(), NOW()),
('2024-07-14', 'A010', 75.00, NOW(), NOW());

-- Insertion des ventes
INSERT INTO vente (id, produits_cout_vente, date, quantite, created_at, updated_at)
VALUES 
('V001', 1, '2024-07-10', 5, NOW(), NOW()),
('V002', 2, '2024-07-11', 2, NOW(), NOW()),
('V003', 3, '2024-07-12', 10, NOW(), NOW()),
('V004', 4, '2024-07-13', 7, NOW(), NOW()),
('V005', 5, '2024-07-14', 4, NOW(), NOW()),
('V006', 6, '2024-07-15', 6, NOW(), NOW()),
('V007', 7, '2024-07-16', 8, NOW(), NOW()),
('V008', 8, '2024-07-17', 3, NOW(), NOW()),
('V009', 9, '2024-07-18', 5, NOW(), NOW()),
('V010', 10, '2024-07-19', 9, NOW(), NOW());

-- Insertion des mouvements
INSERT INTO mouvements (id, date, produits_cout_vente, quantiteActuelle, quantite_demander)
VALUES 
('M001', '2024-07-15', 1, 10, 5),
('M002', '2024-07-16', 2, 8, 2),
('M003', '2024-07-17', 3, 20, 10),
('M004', '2024-07-18', 4, 14, 7),
('M005', '2024-07-19', 5, 10, 4),
('M006', '2024-07-20', 6, 18, 6),
('M007', '2024-07-21', 7, 16, 8),
('M008', '2024-07-22', 8, 6, 3),
('M009', '2024-07-23', 9, 10, 5),
('M010', '2024-07-24', 10, 20, 9);

-- Insertion des historiques d'achats
INSERT INTO historique_achat (achat, produits, date, quantite)
VALUES 
('A001', 'P001', '2024-07-01', 10),
('A002', 'P002', '2024-07-02', 5),
('A003', 'P003', '2024-07-03', 20),
('A004', 'P004', '2024-07-04', 15),
('A005', 'P005', '2024-07-05', 7),
('A006', 'P006', '2024-07-06', 12),
('A007', 'P007', '2024-07-07', 9),
('A008', 'P008', '2024-07-08', 14),
('A009', 'P009', '2024-07-09', 8),
('A010', 'P010', '2024-07-10', 11);

-- Insertion des historiques de ventes
INSERT INTO historique_vente (vente, produits, date, quantite)
VALUES 
('V001', 'P001', '2024-07-10', 5),
('V002', 'P002', '2024-07-11', 2),
('V003', 'P003', '2024-07-12', 10),
('V004', 'P004', '2024-07-13', 7),
('V005', 'P005', '2024-07-14', 4),
('V006', 'P006', '2024-07-15', 6

),
('V007', 'P007', '2024-07-16', 8),
('V008', 'P008', '2024-07-17', 3),
('V009', 'P009', '2024-07-18', 5),
('V010', 'P010', '2024-07-19', 9);
