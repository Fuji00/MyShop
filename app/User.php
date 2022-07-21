<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    
    
    public function likes(){
        return $this->hasmany('App\Like');
    }
    public function items(){
        return $this->hasmany('App\Item');
    }
    public function orders(){
        return $this->hasmany('App\Order');
    }
    
    public function likeItems(){//自分がいいねをしているアイテム情報を取得するため
        return $this->belongsToMany('App\Item','likes')->withPivot('created_at')->orderBy('pivot_created_at','DESC');
    }
    public function orderItems(){//自分がオーダーしたアイテム情報を取得するため
        return $this->belongsToMany('App\Item','orders')
        ->withPivot('updated_at');
    }
    




    public function isEditable($post){
        return $this->isAdmin() || $this->id === $post->user->id;
    }
 
    public function isAdmin(){
        return $this->admin === 1;
    }
/*
    public function user_order_item(){

        return $this->orderItems();
    }*/
}
