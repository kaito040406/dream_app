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
    <form action="/users/{{$user->id}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="text" class="form_name" name="name" placeholder="お名前" value="{{ $user->name }}">
      <input type="text" class="form_year" name="birth_year" placeholder="1993" value="{{ $user->birth_year }}">
      <input type="text" class="form_month" name="birth_month" placeholder="2" value="{{ $user->birth_month }}">
      <input type="text" class="form_day" name="birth_day" placeholder="5" value="{{ $user->birth_day }}">
      <input type="text" class="form_intro" name="intro" placeholder="自己紹介" value="{{ $user->intro }}">
      <input type="file" name="icon" value="{{ $user->icon }}">
      <input type="hidden" name="_method" value="PUT">
      <input type="submit" class="create" value="編  集">
    </form>
  </body>