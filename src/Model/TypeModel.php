<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Model pre číselník typov bicyklov
 */
class TypeModel extends BaseModel
{
    protected string $table = 'types';

    /**
     * Vráti popis modelu po slovensky
     */
    public function describe(): string
    {
        return 'Číselník typov bicyklov';
    }
}
