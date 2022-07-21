@extends('layouts.default')

@section('header')

<!--ナビゲーション　md>三本線が押されたら出る--->
        <div class="collapse navbar-collapse justify-content-end text-center" id="mainNav">
            <ul class="navbar-nav d-inline-flex"><!--d-{breakpoint}-inline-flex はインライン要素として配置--->

                <!--div class="clearfix border">
                    <li class="nav-item"><a class="nav-link" href="{{route('users.show',\Auth::user())}}"><img class="d-sm-block float-md-left my_image" src="{{asset('images/人物.png')}}">マイページ</a></li>
                </div-->

                <div>
                    <li class="nav-item">
                        <form action="{{route('users.show',\Auth::user())}}">
                            @csrf
                            <input type="submit" class="btn btn-light" value="マイページ">
                        </form>
                    </li>
                </div>

                <div>
                    <li class="nav-item">
                        <form action="{{route('items.create')}}">
                            @csrf
                            <input type="submit" class="btn btn-light" value="出品する">
                        </form>
                    </li>
                </div>


                <div>
                    <li class="nav-item">
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <input type="submit" class="btn btn-secondary" value="ログアウト">
                        </form>
                    </li>
                </div>
                
                
                
            </ul>
        </div>

@endsection


