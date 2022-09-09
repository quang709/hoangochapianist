<?php

namespace App\Traits;

trait HandleImage
{
    protected $path = 'upload/news';

    public function verifyImage($request): bool
    {
        if ($request->file('image')) {
            return true;
        }
        return false;
    }

    public function storeImage($request)
    {
        
        if ($this->verifyImage($request)) {
            $image = $request->image;
            $imageExt = $image->getClientOriginalExtension();
            $name = time() . '.' . $imageExt;
            $image->move($this->path, $name);
            return $name;
        }
    }

    public function deleteImage($image)
    {
        if ($image == '') {
            return;
        } else {           
            $path = $this->path . '/' . $image;
            if(file_exists($path)){
                unlink($path);
            }
        }
    }

    public function updateImage($request, $currentImage)
    {      
        if ($this->verifyImage($request)) {
            $this->deleteImage($currentImage);
            return $this->storeImage($request);
        }
        return $currentImage;
    }
}
