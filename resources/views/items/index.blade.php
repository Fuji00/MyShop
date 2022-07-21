@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<div>
    <div>
        <div id="cl" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#cl" data-slide-to="0" class="active"></li>
                <li data-target="#cl" data-slide-to="1"></li>
                <li data-target="#cl" data-slide-to="2"></li>
                <li data-target="#cl" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active"><img src="{{asset('images/konngetu.png')}}" alt="画像" class="d-block w-100"></div>
                <div class="carousel-item"><img src="{{asset('images/go.png')}}" alt="画像" class="d-block w-100"></div>
                <div class="carousel-item"><img src="{{asset('images/kiroku.png')}}" alt="画像" class="d-block w-100"></div>
            </div>
            <a class="carousel-control-prev" href="#cl" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#cl" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        
        
        
    <!--div>
        <form class="search" method="GET" action="{{route('items.index')}}">
            <input type="text" name="keywords[]" value="{{--$keyword--}}" placeholder="キーワードから検索">
            <button type="submit" class="frame">検索</button>
        </form>
    </div-->
    <!--もし一致したら:の左を実行 value="{{--$keywords[0]--}}" value="{{--$keywords[1]--}}"--->


    <div class="row index">
        <aside class="col-md-3 col-lg-2 index_left">
            
            <form class="search" method="GET" action="{{route('items.index')}}">
                @csrf
                <div class="form-group">
                    <label class="w-100">キーワード検索<input type="text" class="form-control" name="keywords_main" placeholder="キーワード" value="@if (!empty($keywords_main)) {{$keywords_main}} @endif"></label>
                </div>
                <div class="form-group">
                    <label class="w-100">キーワード追加<input type="text" class="form-control" name="keywords_add" placeholder="例)値下げ" value="@if (!empty($keywords_add)) {{$keywords_add}} @endif"></label>
                </div>
                <div class="form-group">
                    <label>カテゴリー選択</label>
                    <select name="category_id" class="form-control" value="category_id" {{--data-toggle="select"--}}>
                        
                        <option value="0">指定無し</option>
                        @foreach($categories as $category)
                                <option value={{$category->id}} {{ $category->id == $choiceCategoty ? 'selected' : '' }}>{{$category->name}}</option><!--もし一致したら:の左を実行--->
                        @endforeach
                    </select>
                </div>
                価格
                <div class="form-group">
                    <div class="form-inline justify-content-between">
                        <input type="text" class="form-control col-sm-5" name="price_more" value="{{$price_more}}" placeholder="100">
                        <div>~</div>
                        <input type="text" class="form-control col-sm-5" name="price_less" value="{{$price_less}}" placeholder="1000">
                    </div>
                </div>
                <div class="form-group">
                    <label>並び替え</label><br>
                    <select name="sort_id" class="form-control">
                            <!--option value="" disabled selected>指定無し</option-->
                            <option value="asc" {{ 'asc' == $choiceSort ? 'selected' : '' }} >新着順</option>
                            <option value="desc" {{ 'desc' == $choiceSort ? 'selected' : '' }}>投稿順</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-3">
                    検索
                </button>
            </form>
        </aside>
            
        <main class="offset-1 col-md-8 col-lg-9 index_right">
            <div class="row wrap">
                @forelse($items as $index => $item)
                    <div class="col-6 col-lg-4 mb-5">
                        <div class="card">
                            <h4 class="card-header">
                                @if($item->sold_out_judge($item->id))
                                    <p class="sold_out text-danger">売り切れ</p>    
                                @else
                                    <p class="listing text-primary">出品中</p>
                                @endif
                            </h4>
                            <div class="card-body">
                                <div class="card-title">
                                    <dl>
                                        <dt>商品名</dt>
                                        <dd>{!! nl2br(e($item->name)) !!}</dd>
                                    </dl>
                                </div> 
                                <div>
                                    @if($item->image !== '')
                                        <a href="{{route('items.show',$item->id)}}"><img src="{{asset('storage/'.$item->image)}}" class="w-100 mb-3"></a>
                                    @else
                                        <a href="{{route('items.show',$item->id)}}"><img src="{{asset('images/no_image.png')}}" class="w-100 mb-3"></a>
                                    @endif
                                </div>
                                <div class="card-text">
                                    <dl>
                                        <dt>値段</dt>
                                        <dd>{!! nl2br(e($item->price)) !!}円</dd>
                                    </dl>
                                </div>
                                <div>
                                    <dl>
                                        <dt>カテゴリ</dt>
                                        <dd>{!! nl2br(e($item->category->name)) !!}</dd>
                                    </dl>
                                </div>
                                <div>
                                    <dl>
                                        <dt>出品者</dt>
                                        <dd>{!! nl2br(e($item->user->name)) !!}  様</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>お気に入り登録  <span id="star{{$item->id}}" class="like_button" data-id="{{$item->id}}">{{$item->isLikedBy(Auth::user()) ? '★' : '☆' }}</span>
                                </p>{{--☆-ライクの処理--}}
                                
                                <form method="post" class="like" action="{{-- route('items.toggle_like', $item->id) --}}">
                                    @csrf
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>商品はありません。</p>
                @endforelse
            </div>
            
            {{$items->appends(request()->input())->links()}}
        </main>
    </div>
</div>

    
    
  <script>
    /* global $ */
    /*
                                                    {{---$items->appends(request()->input())->links()---}}
{{---$items->links()---}}


    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
    */
    //asyncプロパティがtrueであれば非同期、falseであれば同期// ★を表示する処理// ☆を表示する処理
    
    
    
    /*
    const ajaxtest=()=>{
    
    //console.log();
    
    //let $item=item;
    
    //console.log($item);
    
        $.ajax({
            url: "/items",
            type: 'POST',
            async: true,     
            dataType: 'json',
            data:{
                uid:100,
            },
        }).done(function(res) {
            if (res.liked) {
                
            } else {
             
            }
        });
    
    }
    
    */
  </script>







@endsection

    

