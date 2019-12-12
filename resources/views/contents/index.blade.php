<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/android-chrome-72x72.png">
    
    <title>Dream Diary</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bl.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <link href="css/_reset.scss" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/per_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/new_content.css') }}" rel="stylesheet">
    
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
      <div class="main_new_content">
        <div class="main_box">
          <form action="/users/{{$user->id}}/contents" id="content_create_bottan" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="text" class="title_form" name="title" placeholder="タイトル">
            <div class="form_box_content">
                <textarea class="form_body" name="body" placeholder="メッセージ"></textarea>
            </div>
            <input type="submit" class="content_create_bottan" id="ontent_create_bottan" value="投  稿">
          </form>
        </div>
      </div>
    @endif
  </body>
</html>