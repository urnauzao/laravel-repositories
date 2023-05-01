<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;
 
    protected $fillable = [
        'id',
        'user_id',
        'categoria_id',
        'nome',
        'sku',
        'descricao',
        'preco',
        'desconto',
        'preco_com_desconto',
        'estoque',
        'referencia',
        'codigo_de_barras',
        'altura',
        'largura',
        'comprimento',
        'peso',
        'tipo',
        'atributos',
        'tags',
        'imagem_principal',
        'imagens',
        'url',
        'fornecedor',
    ];

    protected $casts = [
        'preco' => 'float',
        'desconto' => 'float',
        'preco_com_desconto' => 'float',
        'estoque' => 'integer',
        'altura' => 'integer',
        'largura' => 'integer',
        'comprimento' => 'integer',
        'peso' => 'integer',
        'atributos' => 'array',
        'tags' => 'array',
        'imagens' => 'array',
    ];



}
