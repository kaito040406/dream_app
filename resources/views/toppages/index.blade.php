<!doctype html><!-- HTML5-->
<html lang="ja">
  <head>
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
                <a href="{{ route('logout') }}">ログアウト</a>
              </div>
            </div>
            
          @else
            <a href="{{ route('login') }}">ログイン</a>
            <a href="{{ route('register') }}">新規登録</a>
          @endif
        </div>
    </header>
    <div class="main_page">
      <div class="d_image_box">
        <img src="/images/1720429.png" alt="inu" class="d_image">
      </div>
      <div class="d2_image_box">
        <img src="/images/illust3199.png" alt="inu" class="my_image">
      </div>
    </div>
  </body>
</html>