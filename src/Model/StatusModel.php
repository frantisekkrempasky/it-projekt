<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Model pre číselník stavov bicyklov
 */
class StatusModel extends BaseModel
{
    protected string $table = 'statuses';

    /**
     * Vráti popis modelu po slovensky
     */
    public function describe(): string
    {
        return 'Číselník stavov bicyklov';
    }
}
