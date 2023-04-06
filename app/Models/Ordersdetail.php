<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordersdetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id',
    'product_id','name','itemnumber',
    'upc','pallet',
    'price','amount','notes','finalprice',
    'qtyone','qtytwo','qtythree'

    ];

    protected $table = 'ordersdetails';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
