<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package App\Models
 * @property $product_id Id of product
 * @property $price Price on moment of movement
 * @property $previous_balance Previous balance on movement
 * @property $movement Value of movement
 * @property $final_balance Final balance on movement
 * @property $product_name Product name
 */
class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'price',
        'previous_balance',
        'movement',
        'final_balance'
    ];

    protected $appends = [
        'product_name'
    ];

    const RULES_POST = [
        '*.product_id' => 'required|exists:products,id',
        '*.movement' => 'required|numeric',
    ];

    /**
     * Set previous balance
     * @param double $value
     */
    public function setPreviousBalanceAttribute($value)
    {
        $previous_balance = 0;
        // if set manually
        if ($value){
            $this->attributes['previous_balance'] = $value;
            return $value;
        }
        $lastMovement = self::query()->where('product_id', $this->attributes['product_id'])->orderBy('id', 'desc')->first();
        if ($lastMovement){
            $previous_balance = $lastMovement->final_balance;
        }
        $this->attributes['previous_balance'] = $previous_balance;
    }

    /**
     * Set last balance
     * @param $value
     */
    public function setFinalBalanceAttribute($value)
    {
        $final_balance = 0;
        // if set manually
        if ($value){
            $this->attributes['final_balance'] = $value;
            return $value;
        }
        $lastMovement = self::query()->orderBy('id', 'desc')->first();
        if ($lastMovement){
            $final_balance = ($lastMovement->final_balance + $this->attributes['movement']);
        }

        $this->attributes['final_balance'] = $final_balance;
    }

    /**
     * Set price of product
     * @param $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = 0;
        $product = Product::find($this->attributes['product_id']);
        if ($product){
            $this->attributes['price'] = $product->price;
        }
    }

    /**
     * Get product name attribute
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function getProductNameAttribute()
    {
        return $this->product()->first()->name ?? null;
    }

    /**
     * Link product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
