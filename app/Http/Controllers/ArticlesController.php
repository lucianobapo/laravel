<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller {

    public function __construct() {
        $this->middleware('auth',['except'=>'index']);
    }

    /**
     * Show all articles.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        //$articles= Article::latest()->get();
        //$articles= Article::latest('published_at')->get();
        //$articles= Article::latest('published_at')->where('published_at','<=',Carbon::now())->get();
        $articles= Article::latest('published_at')->published()->get();
	    return view('articles.index',compact('articles'));
	}

    /**
     * Show a single article.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $article = Article::findOrFail($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the page to create a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('articles.create');
    }

    /**
     * Save a new article.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request) {
        //$input = Request::all();
        //$input['published_at'] = Carbon::now();
        //Article::create(Request::all());
        //Article::create($request->all());
        Auth::user()->articles()->save(new Article($request->all()));
        return redirect('articles');
    }

    /**
     * Show the page to edit a new article.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update an article.
     *
     * @param $id
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, ArticleRequest $request) {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }
}
