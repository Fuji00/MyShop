@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<div class="center show">
    <h1 class="mb-5">{{$title}}</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{route('items.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>商品名：<br><input type="text" name="name" class="form-control"></label>
        </div>
        <div class="form-group">
            <label>商品説明：<br><textarea name="description" rows="10" cols="30" class="form-control"></textarea></label>
        </div>
        <div class="form-group">
            <label>価格：<br><input type="text" name="price" class="form-control"></label>
        </div>
        <div class="form-group">
            <label>カテゴリー:<br>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                    
                        <option value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>画像を選択:<input type="file" name="image"></label>
        </div>
        
        <input type="submit" value="出品" class="btn btn-primary mb-3">
    </form>
    
</div>
    
    
    
    
    
@endsection