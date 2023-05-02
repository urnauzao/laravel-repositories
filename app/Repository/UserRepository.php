<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    protected static $model = User::class;

    public static function findByEmail(string $email){
        return self::loadModel()::query()->where(['email' => $email])->first();

    }

    /**
     * Este método trás o último usuário criado
     * @return void
     */
    public static function findByLastedCreated(){
        return self::loadModel()::query()->orderByDesc('id')->first();
    }
}
