<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller {

    /**
     * Create a new articles controller instance.
     */
    public function __construct() {
        $this->middleware('auth',['except'=> ['index','show']]);
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
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article) {
    //public function show($id) {
        //$article = Article::findOrFail($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the page to create a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $tags = Tag::lists('name','id');
        return view('articles.create',compact('tags'));
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
        //Auth::user()->articles()->save(new Article($request->all()));
        //$article = Auth::user()->articles()->create($request->all());

        //$article->tags()->attach($request->input('tag_list'));
        //$this->syncTags($article, $request->input('tag_list'));

        $this->createArticle($request);

        //flash()->success('Your article has been created!');
        flash()->overlay('Your article has been successfully created!','Good Job');

        return redirect('articles');
    }

    /**
     * Show the page to edit a new article.
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article) {
        $tags = Tag::lists('name','id');
        return view('articles.edit', compact('article', 'tags'));
    }

    /**
     * Update an article.
     *
     * @param Article $article
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Article $article, ArticleRequest $request) {
        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        flash()->overlay('Your article has been successfully updated!','Good Job');

        return redirect('articles');
    }

    /**
     * Sync up a list of tags in the database.
     *
     * @param Article $article
     * @param array $tags
     */
    private function syncTags(Article $article, $tags) {
        $article->tags()->sync(is_null($tags)?array():$tags);
    }

    /**
     * Save a new Article.
     *
     * @param ArticleRequest $request
     * @return mixed
     */
    private function createArticle(ArticleRequest $request) {
        $article = Auth::user()->articles()->create($request->all());
        $this->syncTags($article, $request->input('tag_list'));
        return $article;
    }
}
