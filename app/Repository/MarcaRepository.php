<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Marca;

class MarcaRepository extends AbstractRepository
{
    protected static $model = Marca::class;

    public static function findByMarca(string $nome_marca){
        return self::loadModel()::query()->where(['nome' => $nome_marca])->first();
    }
}
