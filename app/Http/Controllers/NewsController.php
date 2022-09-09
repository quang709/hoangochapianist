<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\HandleImage;

class NewsController extends Controller
{

    use HandleImage;

    public $news;

    public function __construct()
    {
        $this->news = new News;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $news = News::latest()->get();
        return view('news.index', compact('news', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
     
        $news = new News;
        $news->title = $request->title;
        $news->summary = $request->summary;
        $news->title_url = Str::slug($request->title, '-');
        if ($request->image == null) {
            $news->image = '';
        } else {
            $news->image = $this->storeImage($request);
        }
        $news->content = $request->content;
        $news->save();
        $this->news->createNewsHasCategory($news->id, $request->category_id);
        return response()->json(['success' => 'create successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::with('category')->where('id', $id)->get();
        return response()->json(['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {       
        $news = News::find($id);
        $news->title = $request->title;
        $news->summary = $request->summary;
        $news->title_url = Str::slug($request->title, '-');
        $news->content = $request->content;
        if ($request->image == null) {
            unset($request->image);
        } else {
            $news->image = $this->updateImage($request, $news->image);
        }
        $news->save();
        $this->news->updateNewsHasCategory($id, $request->category_id);
        return response()->json(['success' => 'update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $this->deleteImage($news->image);
        $news->delete();
        return response()->json(['success' => 'delete successfully.']);
    }
}
