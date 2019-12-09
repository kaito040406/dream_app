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
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/per_page.css') }}" rel="stylesheet">
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
                <a>{{$user->name}}さんのマイページ</a>
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
      <div class="main_page_per">
        <div class="main_box">
          <div class="use_content_box">
            <div class="per_box">
              <div class="per_img_box">
                <div class="per_img_box_box">
                  @if($user->icon != null)
                    <img src="/public/avatar/{{$user->icon}}" alt="inu" class="icon_image" width="90" height="90">
                  @else
                    <img src="/images/azarasi.png" alt="inu" class="icon_image" width="90" height="90">
                  @endif
                </div>
              </div>
              <div class="per_name">
                {{$user->name}} さん
              </div>
              <div class="content_box">
                <div class="form_box">
                  <a href="/users/{{$user->id}}/contents" method="get">
                    <img src="/images/1720429.png" alt="inu" class="per_image" width="90" height="75">
                      <div class="new_content">新規投稿</div>
                </a><br />
                </div>
                <div class="edit_profile_box">
                  <a href="/users/{{$user->id}}/edit" method="get">
                    <img src="/images/azarasi.png" alt="inu" class="per_image" width="75" height="75">
                      <div class="new_content">Edit profile</div>
                  </a><br />
                </div>
                <div class="likes_box">
                  <a href="" method="get">
                    <img src="/images/illust3199.png" alt="inu" class="per_image" width="75" height="75">
                      <div class="new_content">お気に入り</div>
                  </a><br />
                </div>
                <div class="user_logout_box">
                <a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                    <img src="/images/1550411.png" alt="inu" class="per_image" width="75" height="75">
                      <div class="new_content">
                          <div class="new_content">ログアウト</div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      </div>
                  </a><br />
                </div>
              </div>
            </div>
            <div class = "content_zone">
              <div class="content_box">
                <div class="list_title">
                  投稿一覧
                </div>
                <div class="main_zone">
                  @foreach ($contents as $content)
                    <div class="content_main_box">
                      <div class="content_day">
                        投稿日
                        {{$content->created_at}}
                      </div>
                      <div class="content_title">
                        タイトル:
                        {{$content->title}}
                      </div>
                      <div class="content_body">
                        {{$content->body}}
                      </div>
                      <div class="content_edit_button">
                        <a href="/users/{{$user->id}}/contents/{{$content->id}}/edit" method="get">
                          <img src="/images/illust1109.png" alt="inu" class="content_edit_image" width="45" height="45">
                          <div class="edit_content">編集</div>
                        </a><br />
                      </div>
                      <div class="content_delete_button">
                        <a href="/users/{{$user->id}}/contents/{{$content->id}}/delete" method="get">
                          <img src="/images/namagomi.png" alt="inu" class="content_edit_image" width="50" height="45">
                          <div class="edit_content">削除</div>
                        </a><br />
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </body>
</html>