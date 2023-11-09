<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Service\FrontendService;

class FrontendController extends Controller
{
  protected FrontendService $frontendService;

  public function __construct(FrontendService $frontendService)
  {
    $this->frontendService = $frontendService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
  {
    $categories = $this->frontendService->getIndex();
    return view('frontend.index', compact('categories'));
  }

  public function blogCategories($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
  {
    $categories = $this->frontendService->getCategories($slug);
    return view('frontend.blog-category', $categories);
  }

  public function blogDetails($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
  {
    $details = $this->frontendService->getDetails($slug);
    return view("frontend.blog-detail",compact("details"));
  }
}
