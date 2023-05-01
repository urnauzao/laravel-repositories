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
}
