<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\File;
use App\Models\Documents;
use App\Models\Sustainable;

class FileController extends Controller
{
    public function index(Request $request){
        return redirect()->route("panel.index");
    }
    public function show ($folder, $item_id, $name){
        $items = File::where([ 'folder' => $folder, 'item_id' => $item_id ])->orderBy('status','desc')->orderBy('rank')->get();
        return view('panel.file.index', compact('items', 'name', 'folder', 'item_id'));
    }
    public function store(Request $request){
        if($request->hasFile('img')){
            if(
                $request->file('img')->isValid()
                &&
                in_array($request->img->extension(),["jpg","png","jpeg","pdf","docx","doc",'html','xls','xlsx'])
                &&
                in_array($request->img->getMimeType(),["image/jpeg","image/png","image/jpg","application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword","text/html","application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"])
            ){
                $fileName = '';
                for ($i = 1; $i < 120; $i++) {
                    if( ! Storage::exists('public/files/'.$request->folder.'/'.$request->name.'.'.$request->img->extension()) ){
                    // if( ! Storage::exists($request->folder.'/'.$request->name.'.'.$request->img->extension()) ){
                        $fileName = $request->name.'.'.$request->img->extension();
                        break;
                    } else if ( ! Storage::exists('public/files/'.$request->folder.'/'.$request->name.'-'.$i.'.'.$request->img->extension())) {
                    // } else if ( ! Storage::exists($request->folder.'/'.$request->name.'-'.$i.'.'.$request->img->extension())) {
                        $fileName = $request->name.'-'.$i.'.'.$request->img->extension();
                        break;
                    }
                }
                $item = new File();
                $item->name = $fileName;
                $item->title = Str::replace(['.pdf','.PDF','.docx','.doc','.html','.htm','.xlsx'],Null,$request->img->getClientOriginalName());
                $item->description = '';
                $item->folder = $request->folder;
                $item->item_id = $request->item_id;
                $item->rank = 0;
                $item->status = 1;
                $save = $item->save();
                if( $save ){
                    Storage::putFileAs('public/files/'.$request->folder, $request->file('img'), $fileName);
                    // Storage::putFileAs($request->folder, $request->file('img'), $fileName);
                }
                $images = File::where(['folder' => $request->folder, 'item_id' => $request->item_id])->orderBy('rank')->get();
                return $images;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    public function edit($id){
        $item = File::findOrFail($id);
        return view('panel.file.edit',compact('item'));
    }
    public function update($id,Request $request){
        $request->validate([
            "title"=>"required",
        ]);
        $item = File::findOrFail($id);
        $item->title = $request->title;
        $item->description = $request->description;
        if($item->save()){
            if($item->folder == "documents"){
                $surname = Sustainable::where('id',$item->item_id)->value("slug");
            }
            return redirect()->route('panel.file.show',['folder'=>$item->folder,'item_id'=>$item->item_id,'name'=>$surname]);
        }
        return view('panel.file.edit',compact('item'));
    }
    public function status($id, Request $request){
        File::where('id', $id)->update(['status' => $request->data === 'true' ? 1 : 0]);
    }
    public function rank( Request $request ){
        $data = $request->data;
        parse_str($data, $order);
        $items = $order['ord'];
        foreach( $items as $rank => $id ){
            File::where('id', $id)->where('rank', '<>', $rank )->update(['rank' => $rank]);
        }
    }
    public function destroy($id){
        // File::destroy($id);
        $file = File::findOrFail($id);
        // Storage::delete('public/'.$file->folder.'/'.$file->name);
        if(Storage::disk('public')->delete('files/'.$file->folder.'/'.$file->name)){
        // if(Storage::delete($file->folder.'/'.$file->name)){
            $file->delete();
        }
        $file->delete();
        return back();
    }
}
