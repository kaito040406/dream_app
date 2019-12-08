<!doctype html><!-- HTML5-->
<html lang="ja">
  <head>
    <!-- 以下の meta tags（charset と viewport）は必須です-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap の CSS（CDN経由）の読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link href="{{asset("css/main_page.css")}}" rel="stylesheet"> -->
    
    <title>Dream Diary</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <link href="css/_reset.scss" rel="stylesheet" type="text/css">
    <link href="css/main_page.scss" rel="stylesheet" type="text/css">
  </head>
  <body>
    <header>
      <h2>Dream diary</h2>
      @if( Auth::check() )
        <a href="{!! action('TopController@index') !!}">Home</a>
        <div class = "use_name_box">
          {{$user->name}}
        </div>
        <a href="/users/{{$user->id}}">{{$user->name}}さんのマイページ</a><br />
        <a href="{{ route('logout') }}">ログアウト</a>
      @else
        <a href="{{ route('login') }}">ログイン</a>
        <a href="{{ route('register') }}">新規登録</a>
      @endif
    </header>
  </body>
</html>