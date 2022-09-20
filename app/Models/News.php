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
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function createNewsHasCategory($id, $category_id)
    {
        if (isset($category_id)) {
            foreach ($category_id as $cat) {
                DB::table('category_news')->insert([
                    'category_id' => $cat,
                    'news_id' => $id
                ]);
            }
        }
    }

    public function updateNewsHasCategory($id, $category_id)
    {
        if (DB::table('category_news')->where('news_id', $id) != null) {
            DB::table('category_news')->where('news_id', $id)->delete();
        }
        foreach ($category_id as $cat) {
            DB::table('category_news')->insert([
                'category_id' => $cat,
                'news_id' => $id
            ]);
        }
    }
}
