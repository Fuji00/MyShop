<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Item extends Model
{
    protected $fillable=[
            'user_id',
            'name',
            'description',
            'category_id',
            'price',
            'image'
    ];
    //
    public function likes(){
        return $this->hasmany('App\Like');
    }
    public function orders(){
        return $this->hasmany('App\Order');
    }
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function category(){
      return $this->belongsTo('App\Category');
    }
    
    
    public function orderUsers(){//そのアイテムをオーダーしたユーザー情報取得のため
        return $this->belongsToMany('App\User','orders');
    }
    public function likedUsers(){//そのアイテムをいいねしたユーザー情報取得のため
        return $this->belongsToMany('App\User','likes');
    }
    
    
    
    
    public function isLikedBy($user){
        $liked_users_ids=$this->likedUsers->pluck('id');
      
        $result=$liked_users_ids->contains($user->id);
        return $result;
    }
    
    
    
     //売り切れかどうかを判定するメソッド
    public function sold_out_judge($item){
        //dd($item);
        $orders=Order::pluck('item_id');
        //dd($orders);
        $result=$orders->contains($item);
        //dd($result);
        return $result;
        
        // return $this->orders->count() > 0;
    }
    
    
   
    public function scopeSearch($query, $wordList) {
        foreach($wordList as $word) {
            if (empty($word) !== true) {
                $query = $query->where('name', 'like', "%{$word}%");
            }
        }
        return $query;
    }
    
    
}
