@extends('layouts.mypage')

@section('title',$title)

@section('content')
<div class="">
    <h1>{{$title}}</h1>
    <div class="mb-5 bg-white p-3" style="margin:auto; width:300px;">
        <div class="text-center">
            @if($user->image!== '')
                <a><img src="{{asset('storage/'.$user->image)}}" class="mb-md-1 rounded-circle"></a>
            @else
                <a><img src="{{asset('images/no_image.png')}}" class="mb-md-1 rounded-circle"></a>
            @endif
        </div>
        <div>
            <dl>
                <dt>名前</dt>
                <dd>{!! nl2br(e($user->name)) !!}さん</dd>
            </dl>
            
        </div>
        <div>
            <dl>
                <dt>自己紹介文</dt>
                <dd class="text-break">{!! nl2br(e($user->profile)) !!}</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>出品数</dt>
                <dd>{{$item_count}}品</dd>
            </dl>
        </div>
        <div>
            <ul class="nav">
                <div>
                    <li class="nav-item">
                        <form action="{{route('profile.edit_image',$user->id)}}">
                            @csrf
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="画像を変更">
                        </form>
                    </li>
                </div>
                <div>
                    <li class="nav-item">
                        <form action="{{route('profile.edit',$user->id)}}">
                            @csrf
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="プロフィール編集">
                        </form>
                    </li>
                </div>
            </ul>
        </div>
    </div>
    
    







    <h1>購入履歴</h1>
    <div  class="mb-5">
        <div class="row">
            @forelse($user_orders as $user_order)
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body"> 
                        <div>
                            <dl class="row">
                                <dt class="col-md-4">商品名</dt>
                                <dd class="col-md-8">{!! nl2br(e($user_order->name)) !!}</a></dd>
                            </dl>
                        </div>
                        <div>
                            <div>
                                @if($user_order->image !== '')
                                    <a href="{{route('items.show',$user_order->id)}}"><img src="{{asset('storage/'. $user_order->image)}}"></a>
                                @else
                                    <a href="{{route('items.show',$user_order->id)}}"><img src="{{asset('images.no_image.png')}}"></a>
                                @endif
                            </div>
                        </div>
                        <div>
                            <dl>
                                <dt>値段</dt>
                                <dd>{!! nl2br(e($user_order->price)) !!}円</dd>
                            </dl>
                        </div>
                        <div>
                            <dl>
                                <dt>カテゴリ</dt>
                                <dd>{{$user_order->category->name}}</dd>
                            </dl>
                        </div>
                        <div>
                            <dl>
                                <dt>出品者</dt>
                                <dd>{!! nl2br(e($user_order->user->name)) !!}  様</dd>
                            </dl>
                        </div>
                        
                        <div>
                            <dl>
                                <dt>注文日時</dt>
                                <dd>{{$user_order->pivot->updated_at}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            
            @empty
                <p>購入した商品はありません。</p>
            @endforelse
        </div>
    </div>
</div>
{{$user_orders->links()}}

    
    
@endsection