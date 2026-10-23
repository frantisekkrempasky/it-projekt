<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Model pre číselník doplnkov
 */
class AccessoryModel extends BaseModel
{
    protected string $table = 'accessories';

    /**
     * Vráti popis modelu po slovensky
     */
    public function describe(): string
    {
        return 'Číselník doplnkov bicyklov';
    }
}
