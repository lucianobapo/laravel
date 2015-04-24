<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    /**
     * Fillable fields for an Address.
     *
     * @var array
     */
    protected $fillable = [
        'mandante',
        'partner_id',
        'cep',
        'logradouro',
    ];

    /**
     * An Address is owned by a partner.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(){
        return $this->belongsTo('App\Partner');
    }
}
