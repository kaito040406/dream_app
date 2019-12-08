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
    <form action="/users/{{$user->id}}/contents" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      <input type="text" class="form" name="title" placeholder="タイトル">
      <div class="form_box">
          <textarea class="form" name="body" placeholder="メッセージ"></textarea>
      </div>
      <input type="submit" class="create" value="投  稿">
    </form>
  </body>