<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
class LikeController extends Controller
{
     public function __construct(){
       $this->middleware('auth');
   }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $like_items=\Auth::user()->likeItems()->paginate(5);
        //dd($like_items);
        return view('likes.index',[
            'title'=>'お気に入り一覧',
            'like_items'=>$like_items,
        ]);
    }

   
}
