<?php

namespace Tests\Feature\Repository;

use App\Interfaces\RepositoryInterface;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// sail artisan test --filter=UserRepositoryTest
class UserRepositoryTest extends TestCase
{
    private static string $entidade = "Usuário";

    private static function repository():UserRepository|RepositoryInterface{
        return new UserRepository;
    }

    // sail artisan test --filter=UserRepositoryTest::test_all
    public function test_all(): void
    {
        $users = self::repository()->all();
        foreach($users as $user){
            dump($user['id'] . " | " . $user['name']);
        }
        $this->assertNotEmpty($user);
        dump(self::$entidade."s. Total: " . $users->count());
    }

    // sail artisan test --filter=UserRepositoryTest::test_create
    public function test_create(): void
    {
        $user = self::repository()->create(
            [
                ...User::factory()->make()->toArray(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
        $this->assertIsInt($user->id);
        $this->assertNotEmpty($user->id);
        dump(self::$entidade." criado. Id: " . $user->id);
    }

    // sail artisan test --filter=UserRepositoryTest::test_update
    public function test_update(): void
    {
        $user = User::query()->inRandomOrder()->first(['id']);
        $result = self::repository()->update($user->id, [ 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        $this->assertEquals($result, 1);
        dump(self::$entidade." atualizado. Id: " . $user->id);
    }

    // sail artisan test --filter=UserRepositoryTest::test_find
    public function test_find(): void
    {
        $user = User::query()->inRandomOrder()->first(['id']);
        $user = self::repository()->find($user->id);
        $this->assertNotEmpty($user->id);
        $this->assertNotEmpty($user->name);
        dump(self::$entidade." encontrado. Id: " . $user->id);
    }

    // sail artisan test --filter=UserRepositoryTest::test_delete
    public function test_delete(): void
    {
        $user = User::query()->orderByDesc('id')->first(['id']);
        $result = self::repository()->delete($user->id);
        $this->assertNotEmpty($result);
        dump(self::$entidade." removido. Id: " . $user->id);
    }

    // sail artisan test --filter=UserRepositoryTest::test_find_by_email
    public function test_find_by_email(){
        $user = User::query()->orderByDesc('id')->first(['email']);
        $user = self::repository()->findByEmail($user->email);
        $this->assertNotEmpty($user);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->id);
        dump(self::$entidade." escolhido. Email: " . $user->email);
    }
}
