@extends('layouts.default')

@section('header')
<div class="collapse navbar-collapse justify-content-end text-center" id="mainNav">
    <ul class="navbar-nav d-inline-flex"><!--d-{breakpoint}-inline-flex はインライン要素として配置--->
        <div>
            <li class="nav-item">
                <form action="{{route('users.show',\Auth::user())}}">
                    @csrf
                    <input type="submit" class="btn btn-light" value="プロフィール">
                </form>
            </li>
        </div>
        <div>
            <li class="nav-item">
                <form action="{{route('likes.index')}}">
                    @csrf
                    <input type="submit" class="btn btn-light" value="お気に入り一覧">
                </form>
            </li>
        </div>
        <div>
            <li class="nav-item">
                <form action="{{route('users.exhibitions',\Auth::user())}}">
                    @csrf
                    <input type="submit" class="btn btn-light" value="出品商品一覧">
                </form>
            </li>
        </div>
        
        <!--li class="nav-item"><a class="nav-link" href="{{route('users.show',\Auth::user())}}">プロフィール</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('likes.index')}}">お気に入り一覧</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('users.exhibitions',\Auth::user())}}">出品商品一覧</a></li-->
        
    </ul>
</div>


@endsection
