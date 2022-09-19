<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";

    protected $fillable = ['name', 'name_url','parent_id'];

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
 
    public function getCategoriesNews()
    {
      $categories = Category::orderBy('id','desc')->get();
    
      $listCategory = [];
   
      Category::recursive($categories,$parents = 0 ,$level=1, $listCategory);
      return $listCategory;
      
    }
    public static function recursive($categories,$parents = 0 ,$level=1, &$listCategory)
    {
        if(count($categories)>0){
            foreach($categories as $key => $value){

                if($value->parent_id == $parents)
                {
                    $value->level = $level;
                
                    $listCategory[] = $value;
                
                    unset($categories[$key]);
                
                    $parent = $value->id;
                
                    self::recursive($categories,$parent ,$level+1, $listCategory);
                }
            }
        }
    }

    
    


  
}
