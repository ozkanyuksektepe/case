<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PanelController extends Controller
{
    public function index(Request $request){
        return view('panel.index');
    }
}
