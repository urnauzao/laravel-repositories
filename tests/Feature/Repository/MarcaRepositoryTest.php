<?php

namespace Tests\Feature\Repository;

use App\Interfaces\RepositoryInterface;
use App\Models\Marca;
use App\Repository\MarcaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// sail artisan test --filter=MarcaRepositoryTest
class MarcaRepositoryTest extends TestCase
{
    private static string $entidade = "Marca";

    private static function repository():MarcaRepository|RepositoryInterface{
        return new MarcaRepository;
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_all
    public function test_all(): void
    {
        $models = self::repository()->all();
        foreach($models as $model){
            dump($model['id'] . " | " . $model['nome']);
        }
        $this->assertNotEmpty($models);
        dump(self::$entidade."s. Total: " . $models->count());
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_create
    public function test_create(): void
    {
        $_ = Marca::factory()->make()->toArray();
        if(MarcaRepository::findByMarca($_['nome'])){
            $_['nome'] .= now()->timestamp;
        }
        $model = self::repository()->create( $_ );
        $this->assertIsInt($model->id);
        $this->assertNotEmpty($model->id);
        dump(self::$entidade." criado. Id: " . $model->id);
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_update
    public function test_update(): void
    {
        $model = Marca::query()->inRandomOrder()->first(['id', 'nome']);
        $result = self::repository()
        ->update($model->id, [ 'nome' => str($model->nome)->ucfirst()]);
        $this->assertEquals($result, 1);
        dump(self::$entidade." atualizado. Id: " . $model->id);
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_find
    public function test_find(): void
    {
        $model = Marca::query()->inRandomOrder()->first(['id']);
        $model = self::repository()->find($model->id);
        $this->assertNotEmpty($model->id);
        $this->assertNotEmpty($model->nome);
        dump(self::$entidade." encontrado. Id: " . $model->id);
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_delete
    public function test_delete(): void
    {
        $model = Marca::query()->orderByDesc('id')->first(['id']);
        $result = self::repository()->delete($model->id);
        $this->assertNotEmpty($result);
        dump(self::$entidade." removido. Id: " . $model->id);
    }

    // sail artisan test --filter=MarcaRepositoryTest::test_find_by_email
    public function test_find_by_nome_marca(){
        $model = Marca::query()->orderByDesc('id')->first(['nome']);
        $model = self::repository()->findByMarca($model->nome);
        $this->assertNotEmpty($model);
        $this->assertNotEmpty($model->nome);
        $this->assertNotEmpty($model->id);
        dump(self::$entidade." escolhido. Nome: " . $model->nome);
    }
}
