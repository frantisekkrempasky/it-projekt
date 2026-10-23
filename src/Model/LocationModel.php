<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Model pre číselník pobočiek
 */
class LocationModel extends BaseModel
{
    protected string $table = 'locations';

    /**
     * Vráti popis modelu po slovensky
     */
    public function describe(): string
    {
        return 'Číselník pobočiek';
    }
}
