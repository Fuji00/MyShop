@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<div class="center edit">
    <h1>{{$title}}</h1>
    <form method="post" action="{{route('profile.update',$user)}}">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>名前:
                <br>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </label>
        </div>
            
        <div class="form-group">
            <label>プロフィール:
                <br>
                <textarea rows="10" cols="30" class="form-control" name="profile">{{$user->profile}}</textarea>
            </label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">
            更新
        </button>
        
    </form>
</div>
    
@endsection