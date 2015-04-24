<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\FooRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class FooController extends Controller {

//    private $repository;
//
//    public function __construct(FooRepository $repository) {
//	    $this->repository = $repository;
//	}

    public function foo(FooRepository $repository) {
//        dd(trans('email.userCreatedSubject'));
        dd(Lang::get('pagination.next'));
//        return $repository->get();
	}

}
