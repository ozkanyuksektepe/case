<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    // Sadece klasör adı değiştirilecek
    public function cover(){
        return $this->hasOne(Image::class, 'item_id', 'id')->where(['folder' => 'blog-category', 'cover' => 1, 'status' => 1]);
    }
    public function images(){
        return $this->hasMany(Image::class, 'item_id', 'id')->where(['folder' => 'blog-category', 'cover' => 0, 'status' => 1]);
    }
    public function url(){
      return $this->slug.'-'.$this->id;
    }
}
