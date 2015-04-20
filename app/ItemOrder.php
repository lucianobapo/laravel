<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model {

    /**
     * Fillable fields for an Item Order.
     *
     * @var array
     */
    protected $fillable = [
        'mandante',
        'quantidade',
        'valor_unitario',
        'desconto_unitario',
        'descricao',
    ];

    /**
     * An Item Order belongs to an Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo('App\Order');
    }

}
