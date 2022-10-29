<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits;
use App\Traits\HandleImage;

class ProductController extends Controller
{

     use HandleImage;
    protected $category;
    protected $products;

    public function __construct()
    {
        $this->category = New Category();
        $this->products = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->category->getCategoriesNews();
        $products = Product::latest()->get();
        return view('admin.products.index',compact('products','category'));
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
    public function store(StoreProductRequest $request)
    {
      
        $products = new Product();
        $products->name = $request->name;
        $products->name_url =Str::slug($request->name, '-');
        $products->description = $request->description;
        $products->price = $request->price;
        if ($request->image == null) {
            $products->image = '';
        } else {
            $products->image = $this->storeImage($request);
        }
   
        $products->save();
        $this->products->createProductHasCategory($products->id, $request->category_id);
        return response()->json(['success' => 'create successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->where('id', $id)->get();
        $category = Category::all();
        return response()->json(['product' => $product, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,$id)
    {
        $products = Product::find($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->name_url = Str::slug($request->name, '-');
        if ($request->image == null) {
            unset($request->image);
        } else {
            $products->image = $this->updateImage($request, $products->image);
        }
        $products->save();
        $this->products->updateProductHasCategory($id, $request->category_id);
        return response()->json(['success' => 'update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $this->deleteImage($products->image);
        $products->delete();
        return response()->json(['success' => 'delete successfully.']);
     }
}
