<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 14/04/15
 * Time: 02:30
 */

namespace App\Repositories;


class FooRepository {
    public function get() {
        $ret = new \App\OldOrder;
        return $ret->listar();
        //return ['array', 'of'];

    }
}