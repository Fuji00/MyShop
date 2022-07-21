@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h1 class="mb-5">{{$title}}</h1>
<div class="bg-light p-3" style="margin:auto; width:300px;">
    <div class="text-center">
        <h3 class="mb-3">現在の画像</h3>

        <div class="mb-5">
            @if($user->image !== '')
                <img src="{{asset('storage/'.$user->image)}}" class="rounded-circle">
            @else
                <img src="{{asset('images/no_image.png')}}" class="rounded-circle">
            @endif
        </div>
    </div>
    <form method="post" action="{{route('profile.update_image',$user->id)}}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        画像を選択:<input type="file" name="image">
        <button type="submit" class="btn btn-primary mb-3 mt-3">
            更新
        </button>
    </form>
    
</div>
   
    
@endsection