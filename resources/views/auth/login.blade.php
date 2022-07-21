@extends('layouts.not_logged_in')
 
@section('content')
<div class="pt-5">
    <div class="p-5 mb-5 border border-dark" style="margin:auto; width:300px;">
          <h1 class="mb-5 text-center">ログイン</h1>
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                  <label>
                    メールアドレス:<br>
                    <input class="form-control" type="email" name="email">
                  </label>
              </div>
          
              <div class="form-group">
                  <label>
                    パスワード:<br>
                    <input class="form-control" type="password" name="password">
                  </label>
              </div>
              <div class="text-center">
                <button class="btn btn-primary mb-3">
                    ログイン
                </button>
              </div>
          </form>
    </div>
</div>
@endsection