<?php
declare(strict_types=1);

namespace App\Model;

use App\Database;
use PDO;

/**
 * Spoločný rodič číselníkov. Má hotové getAll, getById, getCount a delete –
 * potomok doplní len názov tabuľky ($table) a describe().
 * Trieda je abstraktná: new BaseModel() nie je možné, vždy sa používa potomok.
 */
abstract class BaseModel implements ModelInterface
{
    protected PDO $pdo;

    /** Názov tabuľky – nastaví ho každý potomok. */
    protected string $table;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function getCount(): int
    {
        return (int) $this->pdo->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    /** Každý potomok povie, čo je zač. */
    abstract public function describe(): string;
}
