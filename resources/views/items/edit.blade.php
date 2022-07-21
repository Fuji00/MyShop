@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<div class="center edit">
    <h1>{{$title}}</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{route('items.update',$item->id)}}" >
        @csrf
        @method('patch')
        <div class="form-group">
            <label>商品名：<br><input type="text" name=name value="{{$item->name}}" class="form-control"></label>{{---optional($item)->name---}}
        </div>
        <div class="form-group">
            <label>商品説明：<br><textarea name="description" rows="10" cols="30" class="form-control">{{$item->description}}</textarea></label>
        </div>
        <div class="form-group">
            <label>価格：<br><input type="text" name="price" value="{{$item->price}}" class="form-control"></label>
        </div>
        <div class="form-group">
            <label>カテゴリー：</label><br>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                
                    <option value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-3">
            出品
        </button>
    </form>
</div>
    
    
    
    
    
    
    
    
    
    
    
@endsection