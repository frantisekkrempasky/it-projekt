<?php
declare(strict_types=1);

namespace App\Model;

/**
 * Čo musí vedieť každý model v aplikácii.
 * Interface má len podpisy metód – kód je v triedach, ktoré ho implementujú.
 */
interface ModelInterface
{
    /** Všetky záznamy tabuľky. */
    public function getAll(): array;

    /** Jeden záznam podľa id, alebo null, ak neexistuje. */
    public function getById(int $id): ?array;

    /** Počet záznamov v tabuľke. */
    public function getCount(): int;

    /** Zmaže záznam; vráti true, ak sa niečo zmazalo. */
    public function delete(int $id): bool;

    /** Krátky popis modelu pre výpisy a ladenie. */
    public function describe(): string;
}
