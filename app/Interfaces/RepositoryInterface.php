<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public static function all():Collection;
    public static function create(array $attributes):Model|null;
    public static function find(int $id):Model|null;
    public static function delete(int $id):int;
    public static function update(int $id, array $attributes):int;
    public static function loadModel():Model;
}
