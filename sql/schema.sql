-- Sem patrí tvoja schéma: CREATE TABLE pre všetky tabuľky (úloha 3.3).
-- Mazanie tabuliek v spravnom poradi (najprv prepojky, potom hlavna entita, potom ciselniky)
DROP TABLE IF EXISTS bicycle_accessories;
DROP TABLE IF EXISTS bicycle_locations;
DROP TABLE IF EXISTS bicycles;
DROP TABLE IF EXISTS accessories;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS types;

-- Ciselnik typov bicyklov
CREATE TABLE types (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ciselnik stavov bicyklov
CREATE TABLE statuses (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ciselnik pobociek
CREATE TABLE locations (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ciselnik doplnkov
CREATE TABLE accessories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hlavna entita: Bicykle
CREATE TABLE bicycles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type_id INT UNSIGNED NOT NULL,
    status_id INT UNSIGNED NOT NULL,
    price_per_day DECIMAL(6,2) NOT NULL,
    year_bought YEAR NOT NULL,
    -- Typ nesmie zmiznut, kym ho pouziva existujuci bicykel
    CONSTRAINT fk_bicycles_types FOREIGN KEY (type_id) REFERENCES types(id) ON DELETE RESTRICT,
    -- Kazdy bicykel musi mat platny stav
    CONSTRAINT fk_bicycles_statuses FOREIGN KEY (status_id) REFERENCES statuses(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Prepojovacia tabulka M:N pre umiestnenie bicyklov na pobockach
CREATE TABLE bicycle_locations (
    bicycle_id INT UNSIGNED NOT NULL,
    location_id INT UNSIGNED NOT NULL,
    assigned_from DATE NOT NULL,
    PRIMARY KEY (bicycle_id, location_id, assigned_from),
    -- Historia umiestneni nema zmysel bez bicykla
    CONSTRAINT fk_bl_bicycles FOREIGN KEY (bicycle_id) REFERENCES bicycles(id) ON DELETE CASCADE,
    -- Pobocku nemozno zmazat, kym ma priradenu historiu
    CONSTRAINT fk_bl_locations FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Prepojovacia tabulka M:N pre doplnky bicyklov
CREATE TABLE bicycle_accessories (
    bicycle_id INT UNSIGNED NOT NULL,
    accessory_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (bicycle_id, accessory_id),
    -- Priradenie doplnku bez bicykla nema zmysel
    CONSTRAINT fk_ba_bicycles FOREIGN KEY (bicycle_id) REFERENCES bicycles(id) ON DELETE CASCADE,
    -- Doplnok sa neda zmazat, kym ho ma nejaky bicykel priradeny
    CONSTRAINT fk_ba_accessories FOREIGN KEY (accessory_id) REFERENCES accessories(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
