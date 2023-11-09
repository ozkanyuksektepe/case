<?php

namespace App\Service;

use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogService
{
  public function getPost(): \Illuminate\Database\Eloquent\Collection|array
  {
    return Blog::with('cover', 'images')->where('status', 1)->orderBy("rank")->get();
  }

  public function storePost($request): bool
  {
    try {
      $blog = new Blog();
      $blog->blog_category_id = $request->blog_category_id;
      $blog->name = $request->name;
      $blog->slug = Str::slug($request->name);
      $blog->description = $request->description;
      $blog->rank = $request->rank;
      $blog->status = $request->status ? 1 : 0;
      return $blog->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function editPost($id){
    return Blog::findOrFail($id);
  }

  public function updatePost($request, $id){
    try {
      $blog = Blog::findOrFail($id);
      $blog->blog_category_id = $request->blog_category_id;
      $blog->name = $request->name;
      $blog->slug = Str::slug($request->name);
      $blog->description = $request->description;
      $blog->rank = $request->rank;
      $blog->status = $request->status ? 1 : 0;
      return $blog->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function deletePost($id){
    try {
      $item = Blog::findOrFail($id);
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
