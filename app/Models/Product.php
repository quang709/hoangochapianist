<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected  $tabble = 'products';
    protected  $fillable = ['name', 'name_url', 'description','price', 'image'];
    
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function createProductHasCategory($id, $category_id)
    {
        if (isset($category_id)) {
            foreach ($category_id as $cat) {
                DB::table('category_product')->insert([
                    'category_id' => $cat,
                    'product_id' => $id
                ]);
            }
        }
    }

    public function updateProductHasCategory($id, $category_id)
    {
        if (DB::table('category_product')->where('product_id', $id) != null) {
            DB::table('category_product')->where('product_id', $id)->delete();
        }
        foreach ($category_id as $cat) {
            DB::table('category_product')->insert([
                'category_id' => $cat,
                'product_id' => $id
            ]);
        }
    }

    public function scopeWithName($query ,$name)
    {      
       return $name ? $query->where('name', 'LIKE', '%'.$name.'%'): null;
    }
    public function scopeWithPrice($query, $price)
    {
        return $price ? $query->where('price','<=',$price): null;
    }   


}