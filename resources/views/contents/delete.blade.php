<!doctype html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/android-chrome-72x72.png">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <link href="css/_reset.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/per_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/new_content.css') }}" rel="stylesheet">
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
      <form action="/users/{{$user->id}}/contents/{{$content->id}}" method="post">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        <input type="submit" class="delete" value="削　除">
      </form>
    @else
      
    @endif
    </div>
  </body>
</html>