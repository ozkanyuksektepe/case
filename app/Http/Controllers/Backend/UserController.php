<?php

namespace App\Http\Controllers\Backend;

use App\Models\BlogCategory;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  protected UserService $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
  {
    $items = $this->userService->getPost();
    return view('panel.user.index', compact('items'));
  }


  public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
  {
    return view('panel.user.create');
  }


  public function store(Request $request): \Illuminate\Http\RedirectResponse
  {
    $result = $this->userService->storePost($request);
    if(!$result){
      abort(500,"İşlem sırasında hata oluştu!");
    }
    return redirect()->route('panel.user.index')->with('success', 'Kayıt Eklendi');
  }


  public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
  {
    $item = $this->userService->editPost($id);
    return view('panel.user.edit', compact('item'));
  }


  public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
  {
    $result = $this->userService->updatePost($request,$id);
    if(!$result){
      abort(500,"Güncelleme sırasında hata oluştu!");
    }
    return redirect()->route('panel.user.index')->with('success', 'Kayıt Güncellendi');
  }


  public function destroy($id): string
  {
    $result = $this->userService->deletePost($id);
    if(!$result){
      abort(500,"Silme sırasında hata oluştu!");
    }
    return route('panel.user.index');
  }
}
