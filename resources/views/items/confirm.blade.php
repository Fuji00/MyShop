@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1>{{$title}}</h1>
<div class="mb-5 bg-white" style="margin:auto; width:300px;">
    <div class="p-5">
        <div>
            <dl>
                <dt>商品名</dt>
                <dd>{{$item->name}}</dd>
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
                <dd>{{$item->price}}円</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>商品説明</dt>
                <dd class="text-break">{{$item->description}}</dd>
            </dl>
        </div>
        <div>
            <dl>
                <dt>出品日時</dt>
                <dd>{{$item->created_at}}</dd>
            </dl>
        </div>
        <form method="post" action="{{route('items.finish_store',$item->id)}}">
            @csrf
            <button type="submit" class="btn btn-warning mb-3">
                内容を確認し、購入する
            </button>
        </form>
    </div>
</div>



@endsection