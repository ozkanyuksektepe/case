<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{
  public function getPost(): \Illuminate\Database\Eloquent\Collection|array
  {
    return User::all();
  }

  public function storePost($request): bool
  {
    try {
      $item = new User;
      $item->name = $request->name;
      $item->surname = $request->surname;
      $item->email = $request->email;
      $item->password = Hash::make($request->password);
      return $item->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function editPost($id){
    return User::findOrFail($id);
  }

  public function updatePost($request, $id){
    try {
      $item = User::findOrFail($id);
      $item->name = $request->name;
      $item->surname = $request->surname;
      $item->email = $request->email;
      $item->status = $request->status ? 1 : 0;
      if( $request->password ){
        $item->password = Hash::make($request->password);
      }
      return $item->save();
    }catch (\Exception $exception){
      return false;
    }
  }

  public function deletePost($id){
    try {
       return User::findOrFail($id)->delete();
    }catch (\Exception $exception){
      return false;
    }
  }
}
