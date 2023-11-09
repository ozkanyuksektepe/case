<?php

namespace App\Http\Controllers\Backend;

use App\Service\BlogCategoryService;
use App\Service\BlogService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\BlogCategory;
use App\Models\Blog;

class BlogController extends Controller
{
  protected BlogService $blogService;

  public function __construct(BlogService $blogService)
      {
        $this->blogService = $blogService;
      }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $blog = $this->blogService->getPost();
        return view('panel.blog.index', compact('blog'));
    }


    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category = BlogCategory::where('status',1)->get();
        return view('panel.blog.create', compact("category"));
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $result = $this->blogService->storePost($request);
        if(!$result){
          abort(500, "İşlem sırasında hata oluştu!");
        }
        return redirect()->route('panel.blog.index')->with('success', 'Kayıt Eklendi');
    }


    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
      $category = BlogCategory::where('status',1)->get();
      $blog = $this->blogService->editPost($id);
        return view('panel.blog.edit', compact('blog','category'));
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
      $result = $this->blogService->updatePost($request,$id);
      if(!$result){
        abort(500,"Güncelleme sırasında hata oluştu!");
      }
      return redirect()->route('panel.blog.index')->with('success', 'Kayıt Güncellendi');
    }


    public function destroy($id): string
    {
       $result = $this->blogService->deletePost($id);
       if(!$result){
         abort(500,"Silme sırasında hata oluştu!");
       }
      return route('panel.blog.index');
    }
}
