<?php

namespace Tests\Feature\Factories;

use App\Models\Marca;
use App\Models\Produto;
use App\Models\User;
use App\Repository\UserRepository;
use Tests\TestCase;

# sail artisan test --filter=FactoryTest
class FactoryTest extends TestCase
{
    public function test_main(){
        User::factory(5)->create()->each(
            fn($user) => Produto::factory(random_int(1,20))->create(['user_id' => $user->id])
        );
        try {
            Marca::factory(5)->create();
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
        
        dump(
            "Usuários: ".User::query()->count(),
            "Marcas: ".Marca::query()->count(),
            "Produtos: ".Produto::query()->count()
        );
    }
}
