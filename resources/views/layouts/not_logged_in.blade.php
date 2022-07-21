@extends('layouts.default')

@section('header')
<div class="collapse navbar-collapse justify-content-end text-center" id="mainNav">
<ul class="navbar-nav d-inline-flex"><!--d-{breakpoint}-inline-flex はインライン要素として配置--->
        <div>
            <li class="nav-item">
                <form action="{{route('register')}}">
                    @csrf
                    <input type="submit" class="btn btn-light" value="ユーザー登録">
                </form>
            </li>
        </div>
        <div>
            <li class="nav-item">
                <form action="{{route('login')}}">
                    @csrf
                    <input type="submit" class="btn btn-light" value="ログイン">
                </form>
            </li>
        </div>
    </ul>

</div>




@endsection
