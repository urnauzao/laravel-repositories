<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Produto;
use Exception;

class ProdutoService
{
    public int $limite_por_consulta = 5;

    public function __construct(){
        $this->limite_por_consulta = 10;
    }

    public function maisBarato(){
        $produtos = Produto::query()
        ->where([ "tipo" => 'normal' ])
        ->where('estoque', '>', 0)
        ->orderBy('preco')
        ->limit($this->limite_por_consulta)
        ->get(['id', 'sku', 'nome', 'preco', 'estoque']);

        return $produtos;
    }

    public function maisCaro(){

        $produtos = Produto::query()
        ->where([ "tipo" => 'normal' ])
        ->where('estoque', '>', 0)
        ->orderByDesc('preco')
        ->limit($this->limite_por_consulta)
        ->get(['id', 'sku', 'nome', 'preco', 'estoque']);
        return $produtos;
    }

    public function pesoCubado(Produto $produto):array{
        try{
            $altura = $produto->altura;// resultado em cm
            $largura = $produto->largura;// resultado em cm
            $comprimento = $produto->comprimento;// resultado em cm
            $peso = $produto->peso / 1000; //resultado em kg
            $fator_de_cubagem = 6000;
        }catch(Exception $e){
            logs()->critical($e->getMessage());
            return [
                "altura_cm" => 0,
                "largura_cm" => 0,
                "comprimento_cm" => 0,
                "peso_kg" => 0,
                "pesoCubado" => 0,
            ];
        }
        // calculo do peso cubado
        $pesoCubado = ($altura*$largura*$comprimento ) / $fator_de_cubagem;
        $pesoCubado = round($pesoCubado, 2);
        return [
            "altura_cm" => $altura,
            "largura_cm" => $largura,
            "comprimento_cm" => $comprimento,
            "peso_kg" => $peso,
            "pesoCubado" => $pesoCubado,
        ];
    }
}
