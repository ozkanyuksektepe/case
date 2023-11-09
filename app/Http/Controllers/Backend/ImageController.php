<?php

namespace App\Http\Controllers\Backend;

use App\Models\Image;
use Image4IO\Image4ioApi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        $items = [];
        return view('panel.images.index', compact('items'));
    }
    public function show ($folder, $item_id, $name){
        $items = Image::where([ 'folder' => $folder, 'item_id' => $item_id ])->orderBy('rank')->get();
        return view('panel.images.index', compact('items', 'name', 'folder', 'item_id'));
    }
    public function store(Request $request){
        if( env('CDN') == true ){
            $api = new Image4ioApi(env('CDN_KEY'), env('CDN_SECRET'));
            $images = Image::where('folder', $request->folder)->where('item_id', $request->item_id)->orderBy('id')->get();
            $collect = collect($images);
            if( $images ){
                for ($i = 1; $i < 120; $i++) {
                    if(  !$collect->firstWhere('name', $request->name.'.'.$request->img->extension()) ){
                        $fileName = $request->name.'.'.$request->img->extension();
                        break;
                    }elseif( !$collect->firstWhere('name', $request->name.'-'.$i.'.'.$request->img->extension()) ){
                        $fileName = $request->name.'-'.$i.'.'.$request->img->extension();
                        break;
                    }
                }
            }else{
                $fileName = $request->name.'.'.$request->file->extension();
            }
        }else{
            // for ($i = 1; $i < 120; $i++) {
            //     if( ! Storage::exists('public/'.$request->folder.'/'.$request->name.'.'.$request->img->extension()) ){
            //         $fileName = $request->name.'.'.$request->img->extension();
            //         break;
            //     } else if ( ! Storage::exists('public/'.$request->folder.'/'.$request->name.'-'.$i.'.'.$request->img->extension())) {
            //         $fileName = $request->name.'-'.$i.'.'.$request->img->extension();
            //         break;
            //     }
            // }
            $fileName = $request->name .'-'. Str::random(10) .'.'. $request->img->extension();
        }
        $isCover = Image::where('folder', $request->folder)->where('item_id', $request->item_id)->where('cover', 1)->first();
        $cover = $isCover ? 0 : 1;
        $item = new Image();
        $item->name = $fileName;
        $item->folder = $request->folder;
        $item->item_id = $request->item_id;
        $item->rank = 0;
        $item->status = 1;
        $item->cover = $cover;
        $save = $item->save();
        if( $save ){
            if( env('CDN') == true ){
                $api->uploadImage($request->file('img'), $fileName, '/storage/'.$request->folder, true);
            }else{
                Storage::putFileAs('public/'.$request->folder, $request->file('img'), $fileName);
            }
        }
        $images = Image::where(['folder' => $request->folder, 'item_id' => $request->item_id])->orderBy('rank')->get();
        return $images;
    }
    public function status($id, Request $request){
        $data = $request->data === 'true' ? 1 : 0;
        Image::where('id', $id)->update(['status' => $data]);
    }
    public function cover($id, Request $request){
        $img = Image::find($id);
        $data = $request->data === 'true' ? 1 : 0;
        Image::where('folder', $img->folder)->where('item_id', $img->item_id)->update(['cover' => 0]);
        $img->cover = $data;
        $img->save();
    }
    public function rank( Request $request ){
        $data = $request->data;
        parse_str($data, $order);
        $items = $order['ord'];
        foreach( $items as $rank => $id ){
            Image::where('id', $id)->where('rank', '<>', $rank )->update(['rank' => $rank]);
        }
    }
    public function destroy($id){
        $img = Image::find($id);
        Image::destroy($id);
        if( env('CDN') == true ){
            $api = new Image4ioApi(env('CDN_KEY'), env('CDN_SECRET'));
            $api->deleteImage('/storage/'.$img->folder.'/'.$img->name);
        }else{
            Storage::delete('public/'.$img->folder.'/'.$img->name);
        }
        return back();
    }
}
