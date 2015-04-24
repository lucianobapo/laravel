<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
     * Fillable fields for a Product.
     *
     * @var array
     */
    protected $fillable = [
        'mandante',
        'nome',
    ];

}
