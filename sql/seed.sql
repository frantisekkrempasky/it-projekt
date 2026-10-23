-- Sem patria testovacie dáta: INSERT do všetkých tabuliek (úloha 3.3).
-- Vkladanie do ciselnikov
INSERT INTO types (id, name) VALUES
(1, 'Horský'),
(2, 'Cestný'),
(3, 'Mestský'),
(4, 'Elektrobicykel');

INSERT INTO statuses (id, name) VALUES
(1, 'Dostupný'),
(2, 'Požičaný'),
(3, 'V servise');

INSERT INTO locations (id, name) VALUES
(1, 'Pobočka Hlavná'),
(2, 'Pobočka Sever'),
(3, 'Pobočka Jazero');

INSERT INTO accessories (id, name) VALUES
(1, 'Prilba'),
(2, 'Zámok'),
(3, 'Košík'),
(4, 'Svetlo');

-- Vkladanie do hlavnej entity
INSERT INTO bicycles (id, name, type_id, status_id, price_per_day, year_bought) VALUES
(1, 'Kellys Spider 50', 1, 1, 15.00, 2023),
(2, 'Specialized Allez', 2, 2, 22.50, 2024),
(3, 'CTM City Hunter', 3, 1, 12.00, 2022),
(4, 'Cube Reaction Hybrid', 4, 3, 35.00, 2024);

-- Vkladanie do prepojovacich tabuliek
INSERT INTO bicycle_locations (bicycle_id, location_id, assigned_from) VALUES
(1, 1, '2024-01-15'),
(2, 2, '2024-03-01'),
(3, 1, '2023-05-10'),
(4, 3, '2024-06-20');

INSERT INTO bicycle_accessories (bicycle_id, accessory_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3),
(4, 1),
(4, 4);
