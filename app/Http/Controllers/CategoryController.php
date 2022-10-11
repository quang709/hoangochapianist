<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $category;

    public function __construct()
    {
        $this->category = new Category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category =   $this->category->getCategoriesNews();
        return view('category.index', compact('category'));
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
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->name_url = Str::slug($request->name, '-');
        $category->parent_id = $request->category_id;
        $category->save();
        return response()->json(['success' => 'create successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->name_url = Str::slug($request->name, '-');
        $date = Category::find($request->category_id);
        if ($request->category_id == 0) {
            $category->parent_id = $request->category_id;
        } else {
            if ($request->category_id == $category->id or $category->created_at <  $date->created_at) {
                unset($request->category_id);
            } else {
                $category->parent_id = $request->category_id;
            }
        }

        $category->save();
        return response()->json(['success' => 'update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success' => 'delete successfully.']);
    }
    public function newsofcategory($id)
    {
         $category = $this->category->getCategoriesNews();
         $newsOfCategory = $this->category->newsOfCategory($id);
        return view('category.newsofcategory', compact('newsOfCategory', 'category'));
    }
}
