@extends('layouts.not_logged_in')

@section('content')
<div class="pt-5">
    <div class="p-5 mb-5 border border-dark" style="margin:auto; width:400px;">
        <h1 class="text-center mb-5">ユーザー登録</h1>
        <form method="POST" action="{{route('register')}}">
            @csrf
            <div class="pl-5">
                <div class="form-group">
                    <label>ユーザー名:<br>
                    <input class="form-control" type="text" name="name" class="frame"></label>
                </div>
                
                <div class="form-group">
                    <label>メールアドレス:<br>
                    <input class="form-control"  type="email" name="email" class="frame"></label>
                </div>
                
                <div class="form-group">    
                    <label>パスワード:<br>
                    <input class="form-control" type="password" name="password" class="frame"></label>
                </div>
                
                <div class="form-group">
                    <label>パスワード（確認用）:<br>
                    <input class="form-control" type="password" name="password_confirmation" class="frame"></label>
                </div>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary mb-3 text-center" >
                    登録
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
