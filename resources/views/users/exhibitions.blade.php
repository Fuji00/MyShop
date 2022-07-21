@extends('layouts.mypage')

@section('title',$title)

@section('content')
<div class="index">

    <main>
        <div class="row mb-5">
            <h1 class="col-md-11">{{$title}}</h1>
            <form  action ="{{route('items.create')}}" class="col-md-1">
                @csrf
                <input type="submit" class="btn btn-primary" value="新規出品">
            </form>
        </div>
        
        @forelse($items as $item)
            <div class="border-bottom border-dark mb-5 bg-white p-3">
                <div class="mb-3">
                    @if($item->sold_out_judge($item->id))
                    <a class="border border-dark rounded badge badge-danger text-white">売り切れ</a>    
                    @else
                    <a class="border border-dark rounded badge badge-primary text-white">出品中</a> 
                    @endif
                </div>

                <div class="clearfix">
                    <div>
                        @if($item->image !== '')
                            <a href="{{route('items.show',$item->id)}}"><img src="{{asset('storage/'. $item->image)}}" class="float-md-left mr-md-3 mb-md-1"></a>
                        @else
                            <a href="{{route('items.show',$item->id)}}"><img src="{{asset('images.no_image.png')}}" class="float-md-left mr-md-3 mb-md-1"></a>
                        @endif
                        
                    </div>
                    <div>
                        <dl class="row">
                            <dt class="col-md-2">商品名</dt>
                            <dd class="col-md-10 text-break">{!! nl2br(e($item->name)) !!}</dd>
                        </dl> 
                    </div>
                    <div>
                        <dl class="row">
                            <dt class="col-md-2">値段</dt>
                            <dd class="col-md-10">{!! nl2br(e($item->price)) !!}円</dd>
                        </dl>
                    </div>
                    <div>
                        <dl class="row">
                            <dt class="col-md-2">カテゴリ</dt>
                            <dd class="col-md-10">{{$item->category->name}}</dd>
                        </dl>
                    </div>
                    <div>
                        <dl class="row">
                            <dt class="col-md-2">商品の説明</dt>
                            <dd class="col-md-10 text-break">{!! nl2br(e($item->description)) !!}</dd>
                        </dl>
                    </div>
                    <div>
                        @foreach($orders as $order)
                            @if($item->id===$order->item_id)
                                <div class="border border-success p-3 text-break" style="width:400px">
                                    <div>
                                        <dl class="row">
                                            <dt class="col-md-5">売却日時</dt>
                                            <dd class="col-md-7">{{$order->created_at}}</dd>
                                        </dl>
                                    </div>
                                    <div>
                                        <dl class="row">
                                            <dt class="col-md-5">購入者</dt>
                                            <dd class="col-md-7 text-break">{{$order->user->name}}  様</dd>
                                        </dl>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    <ul class="nav">
                        <div>
                            <li class="nav-item">
                                <form action="{{route('items.edit',$item->id)}}">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-primary btn-sm" value="編集">
                                </form>
                            </li>
                        </div>
                        <div>
                            <li class="nav-item">
                                <form action="{{route('items.edit_image',$item->id)}}">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-primary btn-sm" value="画像を変更">
                                </form>
                            </li>
                        </div>
                        <div>
                            <li class="nav-item">
                                <form method="post" action="{{route('items.destroy',$item)}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-outline-danger btn-sm" value="削除">
                                </form>
                            </li>
                        </div>
                    </ul>
                </div>


                <!--div>alert('Hello, JavaScript!');
                    <dl class="row">
                        <a href="{{route('items.edit',$item->id)}}" class="col-md-12">編集</a>
                    </dl>
                </div>
                <div>
                    <a href="{{route('items.edit_image',$item->id)}}">画像を変更</a>
                </div>
                <form method="post" action="{{route('items.destroy',$item)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form-->
                    
            </div>
        @empty
            <p>出品している商品はありません。</p>
        @endforelse
        {{$items->links()}}

    </main>
</div> 
<script>
    
</script>
@endsection

