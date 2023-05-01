<?php

namespace Database\Factories;

use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // https://github.com/pelmered/fake-car
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));
        $produto = $this->faker->vehicleArray;
        $marca = Marca::query()->firstOrCreate(['nome' => $produto['brand']]);
        return [
            'user_id' => null,
            'marca_id' => $marca->id,
            'nome' => "Carro de Brinquedo ".$produto['brand']." ".$produto['model'],
            'sku' => $this->faker->vin,
            'descricao' => $this->faker->paragraph(),
            'preco' => random_int(10000, 1000000)/100,
            'desconto' => random_int(0,1) > 0 ? random_int(1,20) : 0,
            'preco_com_desconto' => 0,
            'estoque' => random_int(0,10000),
            'referencia' => $this->faker->bothify('?????-#####'),
            'codigo_de_barras' => $this->faker->ean13(),
            'altura' => random_int(10,200),
            'largura'=> random_int(10,200),
            'comprimento'=> random_int(10,200),
            'peso' => random_int(1,5000),
            'tipo' => random_int(0, 6) > 4 ? 'especial':'normal',
            'atributos' => [
                'cor' => $this->faker->safeColorName(),
                'modelo' => $produto['model'],
                'portas' => random_int(2,6),
            ],
            'tags' => array_values($this->faker->vehicleProperties),
            'imagem_principal' => $this->faker->imageUrl(640, 480, $produto['brand']." ".$produto['model'], true),
            'imagens' => [],
            'url' => $this->faker->url(),
            'fornecedor' => null,
        ];
    }
}
