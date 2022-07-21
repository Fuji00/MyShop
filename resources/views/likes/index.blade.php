@extends('layouts.mypage')

@section('title',$title)

@section('content')
<div>
    <h1 class="mb-5">{{$title}}</h1>
    @forelse($like_items as $like_item)
        <div class="border-bottom border-dark mb-5 bg-white p-3">
            <div class="mb-3">
                @if($like_item->sold_out_judge($like_item->id))
                    <a class="border border-dark rounded badge badge-danger text-white">売り切れ</a>    
                @else
                <a class="border border-dark rounded badge badge-primary text-white">出品中</a> 
                @endif
            </div>
            <div class="clearfix">
                @if($like_item->image !== '')
                    <a href="{{route('items.show', $like_item->id)}}"><img src="{{asset('storage/'.$like_item->image)}}" class="float-md-left mr-md-3 mb-md-1"></a>
                @else
                    <a href="{{route('items.show', $like_item->id)}}"><img src="{{asset('images.no_image.png')}}" class="float-md-left mr-md-3 mb-md-1"></a>
                @endif

                <div>
                    <dl class="row">
                        <dt class="col-md-2">商品名</dt>
                        <dd class="col-md-10 text-break">{!! nl2br(e($like_item->name)) !!}</dd>
                    </dl>
                </div>
                <div>
                    <dl class="row">
                        <dt class="col-md-2">値段</dt>
                        <dd class="col-md-10">{!! nl2br(e($like_item->price)) !!}円</dd>
                    </dl>
                </div>
                <div>
                    <dl class="row">
                        <dt class="col-md-2">カテゴリ</dt>
                        <dd class="col-md-10">{{$like_item->category->name}}</dd>
                    </dl>
                </div>
                <div>
                    <dl class="row">
                        <dt class="col-md-2">出品日時</dt>
                        <dd class="col-md-10">({{$like_item->created_at}})</dd>
                    </dl>
                </div>
                <div>
                    <dl class="row">
                        <dt class="col-md-2">商品の説明</dt>
                        <dd class="col-md-10 text-break">{!! nl2br(e($like_item->description)) !!}</dd>
                    </dl>
                </div>
            </div>
            
        </div>
        
    @empty
        <p>商品はありません。</p>
    @endforelse
    {{$like_items->links()}}
</div>
    
@endsection

