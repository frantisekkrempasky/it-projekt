<?php

namespace App\Model;

use PDO;
use PDOException;

class BicycleModel
{
    private $pdo;

    public function __construct()
    {
        try {
            // Pripojenie k databáze pomocou údajov z config.php
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);

            // Nastavenie, aby databáza pri chybe vyhodila výnimku (aby sme nemali bielu obrazovku)
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Ak sa nepodarí pripojiť, vypíše sa presná chyba
            die("Kritická chyba: Nepodarilo sa pripojiť k databáze. Skontroluj heslo v config.php. Detaily: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            // Vytiahnutie všetkých bicyklov z tabuľky
            $stmt = $this->pdo->query("SELECT * FROM bicycles");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Chyba pri sťahovaní dát z tabuľky: " . $e->getMessage());
        }
    }
}
