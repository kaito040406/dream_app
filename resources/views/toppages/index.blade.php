<!doctype html><!-- HTML5-->
<html lang="ja">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 以下の meta tags（charset と viewport）は必須です-->
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link href="{{asset("css/main_page.css")}}" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <link href="css/_reset.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <title>Dream Diary</title>
    
  </head>
  <body>
    <header>
      <div class="head_content">
        <div class="title">
          <a href="{!! action('TopController@index') !!}">
            <div class="text_font">
              Dream diary
            </div>
          </a>
        </div>
          @if( Auth::check() )
            <div class = "par_button">
              <div class = "user_name_box">
                <a href="/users/{{$user->id}}">{{$user->name}}さんのマイページ</a>
              </div>
              <div class = "logout_box">
                <a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </div>
            
          @else
          <div class = "par_button">
            <div class = "user_name_box">
              <a href="{{ route('login') }}">ログイン</a>
            </div>
            <div class = "logout_box">
              <a href="{{ route('register') }}">新規登録</a>
            </div>
          </div>
          @endif
        </div>
    </header>
    <div class="main_page">
    @if( Auth::check() )
      <a href="/users/{{$user->id}}/contents">
        <div class="d_image_box">
          <img src="/images/1720429.png" alt="inu" class="d_image">
        </div>
      </a>
    @else
      <div class="d_image_box">
        <img src="/images/1720429.png" alt="inu" class="d_image">
      </div>
    @endif
      <div class="d2_image_box">
        <img src="/images/illust3199.png" alt="inu" class="my_image">
      </div>
    </div>
  </body>
</html>