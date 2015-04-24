<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model {

    /**
     * Fillable fields for a Partner.
     *
     * @var array
     */
    protected $fillable = [
        'mandante',
        'nome',
    ];

    /**
     * Partner can have many orders.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
        return $this->hasMany('Order');
    }

    /**
     * Partner can have many addresses.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(){
        return $this->hasMany('Address');
    }

}
