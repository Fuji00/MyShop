<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/destyles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
       
 

         <!--bootstrap4の読み込み-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  		<script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
        
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
               
        
    </head>
    <body>
        <header class="header">    
            <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top" style="height:60px"><!--navbarの文字色  background-color:dark  margin-bottom--->
                <a class="nav-link navbar-brand col-6" style="width:200px" href="{{route('home')}}">
              		<img class="logo col-12" src="{{asset('images/logo.png')}}" style="width:200px">
              	</a>
                
                <!--三本線のボタン-->
                   <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
                       <span class="navbar-toggler-icon"></span>
                   </button>
                   @yield('header')
                </div>
            </nav>

            
            
        </header>
    
        <main class="bg-color main">
            <div class="container">
                <div id="dialog">
                    <!--p>お知らせ内容</p-->
                    <div>
                            {{-- エラーメッセージを出力 --}}
                        @foreach($errors->all() as $error)
                            <p class="error text-danger">{{ $error }}</p>
                        @endforeach
                        
                        {{-- 成功メッセージを出力 --}}
                        @if (session()->has('success'))
                            <div class="success text-info">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </main>    
        <footer>
            <div class="container-fuluid bg-light">
                <ul class="nav justify-content-center">
                    <li class="nav-item"><a href="#" class="nav-link">プライバシーポリシー</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">特定商取引に基づく表示</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">利用規約</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">サイトマップ</a></li>
                </ul>
            </div>
        </footer>
        
        <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>

        <script src="{{ asset('js/main.js') }}"></script>
       
    </body>
</html>