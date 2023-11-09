<?php

namespace App\Service;

use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendService
{
  public function getIndex(): \Illuminate\Database\Eloquent\Collection|array
  {
    return BlogCategory::where("status",1)->get();
  }

  public function getCategories($slug)
  {
    try {
      $explode = explode('-',$slug);
      $id = array_pop($explode);
      $categories = BlogCategory::where('id',$id)->orderBy("rank")->firstOrFail();
      return ["blogs" => Blog::where('status', 1)->where('blog_category_id', $id)->get(), "categories" => $categories];
    }catch (\Exception $exception){
      return false;
    }
  }

  public function getDetails($slug){
    try {
      $explode = explode('-',$slug);
      $id = array_pop($explode);
      return Blog::where('id',$id)->orderBy("rank")->firstOrFail();
    }catch (\Exception $exception){
      return false;
    }
  }

}
