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
    @if( Auth::check() )
      <header>
        <h2>Dream diary</h2>
        <a href="{!! action('TopController@index') !!}">Home</a>
        <div class = "use_name_box">
          {{$user->name}}
        </div>
        <a href="{{ route('logout') }}">ログアウト</a>
      </header>
      <div class="use_content_box">
        <div class="form_box">
          <a href="/users/{{$user->id}}/contents" method="get">新規投稿</a><br />
        </div>
        <div class="content_box">
          @foreach ($contents as $content)
            <div class="content_title">
              {{$content->title}}
            </div>
            <div class="content_body">
              {{$content->body}}
            </div>
            <div class="content_edit_button">
              <a href="/users/{{$user->id}}/contents/{{$content->id}}/edit" method="get">編集</a><br />
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </body>
</html>