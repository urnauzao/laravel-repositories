<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\ProdutoService;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function maisBarato(ProdutoService $produtoService){
        return $produtoService->maisBarato()->toArray();
    }

    public function maisCaro(ProdutoService $produtoService){
        return $produtoService->maisCaro()->toArray();
    }
    
    public function pesoCubado(Produto $produto){
        if($produto->tipo !== "normal"){
            throw new Exception("Tipo de produto inválido");
        }

        $produService = new ProdutoService();
        return $produService->pesoCubado($produto);
        
    }
}
