<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\User;
use App\Services\FileUploadService;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   
   
   
   
   
   
   
    public function edit($id)
    {
        //
        $user=\Auth::user();
        return view('profiles.edit',[
            'title'=>'プロフィール編集',
            'user'=>$user,
        ]);
    }
    public function update(ProfileRequest $request){//プロフィール編集受け取り
       
        $user=\Auth::user();
        $user->update($request->only([
            'name','profile'
        ]));
        
        session()->flash('success', 'プロフィール情報を変更しました');
        return redirect()->route('users.show',$user);
   }




    public function edit_image($id){
        $user=User::find($id);
        
        return view('profiles.edit_image',[
            'title'=>'プロフィール画像変更', 
            'user'=>$user,
        
        ]);
   }
   public function update_image($id,ProfileImageRequest $request,FileUploadService $service){
       
       $user=\Auth::user();
       //画像投稿処理
       $path=$service->saveImage($request->file('image'));
    
       
       //変更前の画像を削除
       if($user->image !== ''){
           \Storage::disk('public')->delete($user->image);
       }
       
       $user->update([// ファイル名を保存
            'image'=>$path,   
       ]);
       session()->flash('success', 'プロフィール画像を変更しました');
       return redirect()->route('users.show',$id);
   }
}
