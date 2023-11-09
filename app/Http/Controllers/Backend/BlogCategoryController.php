<?php

namespace App\Http\Controllers\Backend;

use App\Service\BlogCategoryService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
  protected BlogCategoryService $blogCategoryService;

  public function __construct(BlogCategoryService $blogCategoryService)
      {
        $this->blogCategoryService = $blogCategoryService;
      }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $category = $this->blogCategoryService->getPost();
        return view('panel.blog-category.index', compact('category'));
    }


    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('panel.blog-category.create');
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $result = $this->blogCategoryService->storePost($request);
        if(!$result){
          abort(500,"İşlem sırasında hata oluştu!");
        }
        return redirect()->route('panel.blog-category.index')->with('success', 'Kayıt Eklendi');
    }


    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category = $this->blogCategoryService->editPost($id);
        return view('panel.blog-category.edit', compact('category'));
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
      $result = $this->blogCategoryService->updatePost($request,$id);
      if(!$result){
        abort(500,"Güncelleme sırasında hata oluştu!");
      }
      return redirect()->route('panel.blog-category.index')->with('success', 'Kayıt Güncellendi');
    }


    public function destroy($id): string
    {
       $result = $this->blogCategoryService->deletePost($id);
       if(!$result){
         abort(500,"Silme sırasında hata oluştu!");
       }
      return route('panel.blog-category.index');
    }
}
