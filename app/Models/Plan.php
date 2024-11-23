<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    const TYPE = ['day'=>'Dia','month'=>'Mês','year'=>'Ano'];

    protected $fillable = ['title', 'price', 'amount', 'type', 'user_limit'];

}
