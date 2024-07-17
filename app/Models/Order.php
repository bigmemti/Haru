<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'expired_at',
    ];

    const ORDER_CREATED_STATUS = 0;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function totalPrice() : Attribute {
        return Attribute::make(get: fn() => $this->products->reduce(fn(?int $carry, $product) => $carry + ($product->price * $product->pivot->quantity)));
    }
}
