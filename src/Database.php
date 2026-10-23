<?php
declare(strict_types=1);

namespace App;

use PDO;

/**
 * Jedno pripojenie k databáze pre celú aplikáciu (návrhový vzor Singleton).
 * Použitie: $pdo = Database::getInstance();
 */
final class Database
{
    private static ?PDO $instance = null;

    // Súkromný konštruktor: new Database() nie je možné, pripojenie vzniká len cez getInstance().
    private function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $c   = require __DIR__ . '/../config.php';
            $dsn = "mysql:host={$c['host']};dbname={$c['dbname']};charset=utf8mb4";

            self::$instance = new PDO($dsn, $c['user'], $c['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // chyba SQL vyhodí výnimku
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // riadky ako asociatívne polia
                PDO::ATTR_EMULATE_PREPARES   => false,                  // skutočné prepared statements
            ]);
        }

        return self::$instance;
    }
}
