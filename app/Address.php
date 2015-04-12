<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	//

    /**
     * An Address is owned by a user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

}
