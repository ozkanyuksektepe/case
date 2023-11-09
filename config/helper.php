<?php

use App\Models\Image;

if(!function_exists('getCover')){
    function getCover ( $cover = '', $size = '400' ){
        if( $cover ){
            if( env('CDN') == true ){
                // return env('CDN_IMG_PREFIX').'w_'.$size.'/storage/'.$cover->folder.'/'.$cover->name;
                // return env('CDN_IMG_PREFIX').'/storage/'.(config("app.env")=="local"?"test":"production").'/'.$cover->folder.'/'.$cover->name;
                return env('CDN_IMG_PREFIX').'/storage/'.$cover->folder.'/'.$cover->name.'?ts='.time();
            }else{
                return url('/storage/'.$cover->folder.'/'.$cover->name.'?ts='.time());
            }
        }else{
            return url('/backend/assets/img/900x400/img1.jpg');
        }
    }

}


if(!function_exists('getCoverImgUrl')){
    function getCoverImgUrl($folder="",$id=0){
        $name = Image::where('folder',$folder)->where('item_id',$id)->where('cover','1')->value('name');
        if($name){
            if(env('CDN')==true){
                return env('CDN_IMG_PREFIX').'/storage/'.$folder.'/'.$name;
            }else{
                return url('/storage/'.$folder.'/'.$name);
            }
        }else{
            return url('/backend/assets/img/900x400/img1.jpg');
        }
    }
}

if (!function_exists('getDateTr')){
    function getDateTr($date, $hour = false){
        if( $hour == true ){
            return strftime('%d %B %Y - %H:%M', strtotime($date));
        }else{
            return strftime('%d %B %Y', strtotime($date));
        }
    }
}

if(!function_exists('_print_r')){
    function _print_r($variable=false,$name=false){
        echo("<pre>");
        echo($name?$name.': ':false);
        print_r($variable);
        echo("</pre>");
    }
}

if(!function_exists('status')){
    function status($value=0){
        if($value==0){
            return("Pasif");
        }elseif($value==1){
            return("Aktif");
        }elseif($value==2){
            return("Onay Bekliyor");
        }else{
            return("Pasif");
        }
    }
}

if(!function_exists('status_class')){
    function status_class($value=0){
        if($value==0){
            return("bg-secondary");
        }elseif($value==1){
            return("bg-success");
        }elseif($value==2){
            return("bg-warning");
        }else{
            return("bg-secondary");
        }
    }
}

