<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\User;
use App\Item;
use App\Order;

class UserController extends Controller
{
   
   public function __construct(){
       $this->middleware('auth');
   }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
    
        $user=\Auth::user();
        $item_count=Item::where('user_id',$user->id)->count();//user_idが$orderのヤツを取る
/*
        $query=User::query();
        
        $query->user_order_item();
        $user_orders=$query->paginate(1);
*/


        
        $user_orders=$user->orderItems;
        
            //dd($user_orders);
        $user_orders = new LengthAwarePaginator(
            $user_orders->forPage($request->page, 4),
            count($user_orders),
            4,//3ページ以上なら次のページのボタンが表示される？
            $request->page,
            array('path' => $request->url()),
        );
        


        

        return view('users.show',[
            'title'=>'プロフィール',
            'user'=>$user,
            'item_count'=>$item_count,//出品数
            'user_orders'=>$user_orders,//購入一覧
        ]);
    }
   
    
    
    
    
    
   
   
    public function exhibitions($id){
        $user=User::find($id);
       //$items=Item::find($id);
        $items=Item::where('user_id',\Auth::user()->id)->latest()->paginate(5);//user_idとusersのidが一致しているテーブルを得る
        //dd($items);
        //$items=$items->orderUsers;
        $orders=Order::get();

        return view('users.exhibitions',[
            'title'=>'出品商品一覧', 
            'user'=>$user,
            'items'=>$items,
            'orders'=>$orders,
        ]);
   }
}
