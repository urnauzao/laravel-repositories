<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\MarcaRepository;
use Illuminate\Database\Eloquent\Collection;

class MarcaService
{

    public function parceiras():Collection{
        $marcas_parceiras_id = [10, 100, 110];
        return MarcaRepository::getMarcaWhereInIds($marcas_parceiras_id);
    }

    public function proibidas():Collection{
        if(cache()->has("MarcaService::proibidas")){
            return cache()->get("MarcaService::proibidas");
        }

        $marcas_parceiras_id = [5,12,172, 64];
        $result = MarcaRepository::getMarcaWhereInIds($marcas_parceiras_id);
        cache()->add("MarcaService::proibidas", $result, now()->addDay());
        return $result;
    }

    public function validadas():array{
        $parceiras = $this->parceiras();
        $proibidas = $this->proibidas();
        return [
            "parceiras" => $parceiras->pluck('nome'),
            "proibidas" => $proibidas->pluck('nome')
        ];
    }
}
