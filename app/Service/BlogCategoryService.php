<?php

namespace App\Service;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogCategoryService
{
  public function getPost(): \Illuminate\Database\Eloquent\Collection|array
  {
    return BlogCategory::with('cover', 'images')->where('status', 1)->orderBy("rank")->get();
  }

  public function storePost($request): bool
  {
    try {
      $category = new BlogCategory();
      $category->name = $request->name;
      $category->slug = Str::slug($request->name);
      $category->rank = $request->rank;
      $category->status = $request->status ? 1 : 0;
      return $category->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function editPost($id){
    return BlogCategory::findOrFail($id);
  }

  public function updatePost($request, $id){
    try {
      $category = BlogCategory::findOrFail($id);
      $category->name = $request->name;
      $category->slug = Str::slug($request->name);
      $category->rank = $request->rank;
      $category->status = $request->status ? 1 : 0;
      return $category->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function deletePost($id){
    try {
      $item = BlogCategory::findOrFail($id);
      if($item->images){
        foreach($item->images as $image){
          if(Storage::disk('public')->delete($image->folder.'/'.$image->name)){
            $image->delete();
          }
        }
      }
      return $item->delete();
    }catch (\Exception $exception){
      return false;
    }
  }
}
