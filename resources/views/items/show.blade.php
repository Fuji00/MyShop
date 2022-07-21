@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1>{{$title}}</h1>
<div class=" bg-white" style="margin:auto; width:300px;">
    <div class="p-5">
        <div>
            <dl>
                <dt>商品名</dt>
                <dd>{!! nl2br(e($item->name)) !!}</dd>
            </dl>
        </div>
        <div>
            @if($item->image !== '')
            <!--?php dd($item->image)?-->
                <img src="{{asset('storage/'. $item->image)}}" class="mb-3">
            @else
                <img src="{{asset('images/no_image.png')}}" class="mb-3">
            @endif
        </div>
        <div>
            <dl>
                <dt>カテゴリ</dt>
                <dd>{{$category->name}}</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>価格</dt>
                <dd>{!! nl2br(e($item->price)) !!}円</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>商品説明</dt>
                <dd>{!! nl2br(e($item->description)) !!}</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>出品日時</dt>
                <dd>{{$item->created_at}}</dd>
            </dl>
        </div>
            @if($item->sold_out_judge($item->id))
                <button type="submit" class="btn btn-primary mb-3">
                    売り切れ
                </button>
            @else
            @if($item->user_id==$user->id)<!--自分のIDとそのアイテムのuser_idが一致したら-->
                <button type="submit" class="btn btn-primary mb-3">
                    出品中ですぞ
                </button>
            @else
                <form method="post" action="{{route('items.confirm_store',$item->id)}}">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3">
                        購入する
                    </button>
                </form>
            @endif    
        @endif
    </div>
</div>
    
@endsection