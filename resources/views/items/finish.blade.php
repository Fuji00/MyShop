@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1 class="mb-5">{{$title}}</h1>
<div class="">
    <div class="p-5 mb-5 bg-white p-3" style="margin:auto; width:300px;">
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
        <form action="{{route('home')}}">
            <button type="submit" class="btn btn-info mb-3">
                トップに戻る
            </button>
        </form>
    </div>
</div>

@endsection