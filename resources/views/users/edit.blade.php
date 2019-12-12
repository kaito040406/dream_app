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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/user_bl.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <link href="css/_reset.scss" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/per_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/new_content.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user_edit.css') }}" rel="stylesheet">
  </head>
  <body>
    @if( Auth::check() )
    <header>
      <div class="head_content">
        <div class="title">
          <a href="{!! action('TopController@index') !!}">
            <div class="text_font">
              Dream diary
            </div>
          </a>
        </div>
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
        </div>
    </header>
      <div class="user_edit_form">
        <form action="/users/{{$user->id}}" method="post" id="user_edit_bottan" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="f_name_f">
            お名前
            <input type="text" class="form_name" name="name" placeholder="お名前" value="{{ $user->name }}">
          </div>
          <div class="f_birth_f">
            生年月日
            <input type="text" class="form_year" name="birth_year" placeholder="1993" value="{{ $user->birth_year }}">年
            <input type="text" class="form_month" name="birth_month" placeholder="2" value="{{ $user->birth_month }}">月
            <input type="text" class="form_day" name="birth_day" placeholder="5" value="{{ $user->birth_day }}">日
          </div>
          <div class="f_intoro_f">
            一言紹介
            <input type="text" class="form_intro2" name="intro" value="{{ $user->intro }}">
          </div>
          <div class="f_icon_f">
            画像を選択してください
            <input type="file" name="icon" class="file_bottan" value="{{ $user->icon }}">
          </div>
          <div class="f_submit_f">
            <input type="hidden" name="_method" value="PUT">
            <input type="submit" class="create" value="編  集">
          </div>
        </form>
      <div>
    @endif
  </body>