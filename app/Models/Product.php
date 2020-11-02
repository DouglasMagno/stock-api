<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property $name Name of product
 * @property $price Current Price of product
 * @property $qtd Current quantity of products in stock
 * @property $unit Unit of products
 * @property $format Format to show product
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'qtd',
        'unit',
        'format'
    ];

    protected $appends = [
        'qtd_to_show',
        'histories'
    ];

    const RULES_POST = [
        '*.name' => 'required|string',
        '*.price' => 'required|numeric|min:0.01',
        '*.qtd' => 'required|numeric',
        '*.unit' => 'required|string',
        '*.format' => 'required|in:int,double'
    ];

    const RULES_PUT = [
        '*.id' => 'required|exists:products,id',
        '*.name' => 'string',
        '*.price' => 'numeric|min:0.01',
        '*.unit' => 'string',
        '*.format' => 'in:int,double'
    ];

    const RULES_DELETE = [
        // '*.id' => 'required|exists:products,id'
    ];

    public function getQtdToShowAttribute()
    {
        $qtd = 0;
        $formats = (object)[
            'int' => function($value) {
                $value = (int) $value;
                return "{$value} {$this->unit}";
            },
            'double' => function ($value) {
                $value = (double) $value;
                return "{$value} {$this->unit}";
            }
        ];

        if (isset($formats->{$this->format})){
            $qtd = ($formats->{$this->format})($this->qtd);
        }else{
            $qtd = ($formats->int)($this->qtd);
        }

        return $qtd;
    }

    public function getHistoriesAttribute()
    {
        return $this->hasMany(History::class, 'product_id', 'id')->get();
    }
}
