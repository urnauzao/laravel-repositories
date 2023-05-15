<?php

namespace App\Http\Controllers;

use App\Services\MarcaService;

class MarcaController extends Controller
{
    public function marcasParceiras(){
        $marcaService = new MarcaService();
        $result = $marcaService->parceiras();
        return $result->toArray();
    }

    public function marcasProibidas(MarcaService $marcaService){
        $result = $marcaService->proibidas();
        return $result->toArray();
    }

    public function marcasValidadas(MarcaService $marcaService){
        return response()->json($marcaService->validadas());
    }
}
