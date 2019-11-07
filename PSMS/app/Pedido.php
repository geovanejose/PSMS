<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	protected $fillable = [
        'quantidade', 'product_id','user_id',
    ];
}
