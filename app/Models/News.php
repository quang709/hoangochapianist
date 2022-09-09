<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;
    protected $table = "News";
    protected $fillable = ['title', 'title_url', 'content', 'image'];
    // public $dir = 'upload/news/';
    // public function getImageAttribute($value)
    // {
    //     return $this->dir . $value;
    // }   
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function createNewsHasCategory($id, $category_id)
    {
        DB::table('category_news')->insert([
            'category_id' => $category_id,
            'news_id' => $id
        ]);
    }
  
    public function updateNewsHasCategory($id, $category_id)
    {
        DB::table('category_news')->where('news_id',$id)->delete();
        DB::table('category_news')->insert([
            'category_id' => $category_id,
            'news_id' => $id
        ]);
    }
}
