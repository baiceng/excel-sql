<?php

namespace App\Entities;


class Order extends Model
{
    public $timestamps = true;

    protected $table = 'orders';

    protected $fillable = [
        'o_no',
        'o_date',
        'o_seller_name',
        'o_buyer_name',
        'o_product_name',
        'o_product_part_no',
        'o_product_spec',
        'o_product_price',
        'o_currency',
        'o_quantity',
        'o_amount',
        'o_note',
        'user_id',
        'file_name'
    ];

    protected $casts = [
        'o_product_price' => 'double',
        'o_amount' => 'double'
    ];
}
