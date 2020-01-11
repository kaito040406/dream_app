<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/android-chrome-72x72.png">
    <title>Dream Diary</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script type="module" src="{{ asset('js/kuromoji.js') }}"></script>
    <script type="module" src="{{ asset('js/diagnosis.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <script type="module" src="{{ asset('js/graph.js') }}"></script>
    <script type="module" src="{{ asset('js/new_content.js') }}"></script>
    <script type="module" src="{{ asset('js/user_edit.js') }}"></script>
    <script type="module" src="{{ asset('js/scroll.js') }}"></script>
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/per_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/show_new_content.css') }}" rel="stylesheet">
    <link href="{{ asset('css/show_user_edit.css') }}" rel="stylesheet">
  </head>
  <body>
    @if( Auth::id() == $user->id )
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
              <div class = "user_name_box" id = "{{$user->id}}">
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
                    <img src="/public/avatar/{{$user->icon}}" alt="inu" class="icon_image">
                  @else
                    <img src="/images/azarasi.png" alt="inu" class="icon_image">
                  @endif
                </div>
              </div>
              <div class="per_name">
                {{$user->name}} さん
              </div>
              <div class="content_box">
                <div class="form_box">
                  <a>
                    <img src="/images/1720429.png" alt="inu" class="per_image_2">
                      <div class="new_content">新規投稿</div>
                </a><br />
                </div>
                <div class="edit_profile_box">
                  <a>
                    <img src="/images/azarasi.png" alt="inu" class="per_image">
                      <div class="new_content">自分編集</div>
                  </a><br />
                </div>
                <div class="likes_box">
                  <a>
                    <img src="/images/illust3199.png" alt="inu" class="per_image">
                      <div class="new_content">診断結果</div>
                  </a><br />
                </div>
                <div class="user_logout_box">
                <a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                    <img src="/images/1550411.png" alt="inu" class="per_image" width="75" height="75">
                      <div class="new_content">
                          <div class="new_content2">ログアウト</div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      </div>
                  </a><br />
                </div>
              </div>
            </div>

            <div class="new_content_page">
            </div>


            <div class="edit_personal">
              <!-- <div class="edit_personal_in" id = "1"> 
                <div class="close_button">
                  <div class="close_text">
                    ×
                  </div>
                </div>
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
                    <div class = "picture_box">
                      <label>
                        <div class="f_icon_f">
                          画像を選択してください</br>
                          <div class = "pic_box">
                            <span class="filelabel" title="ファイルを選択">
                              <img src="/images/camera.png" width="32" height="32" alt="＋画像">
                            </span>
                          </div>
                          <input type="file" name="icon" class="file_bottan" id = "file_bottan" value="{{ $user->icon }}" accept=".jpg,.png">
                        </div>
                      </label>
                      <div class ="edit_icon_box">
                        <img src="/public/avatar/{{$user->icon}}" alt="inu" class="edit_icon">
                      </div>
                    </div>
                    <div class="f_submit_f">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="submit" class="create" value="編  集">
                    </div>
                  </form>
                </div>
              </div> -->
            </div>


            <div class="graph">
            </div>

            <div class="load">
            </div>

            <div class = "content_zone">
              <div class="content_box">
                <div class="list_title">
                  投稿一覧
                </div>
                <div class="main_zone">
                  @if($contents_count != 0)
                    @foreach ($contents as $content)
                      <div class="content_main_box">
                        <div class="content_day">
                          投稿日
                          {{$content->created_at->format('Y年m月d日')}}
                        </div>
                        <div class="content_title">
                          タイトル:
                          {{$content->title}}
                        </div>
                        <div class="content_body">
                          {{$content->body}}
                        </div>
                        <div class="setting_bottam">
                          <div class="creater_box">
                            <img src="/public/avatar/{{$user->icon}}" alt="inu" class="icon_image_2">
                            <div class="creater_content">{{$user->name}}さんの投稿</div>
                          </div>
                          <div class="content_edit_button">
                            <a href="/users/{{$user->id}}/contents/{{$content->id}}/edit" method="get">
                              <img src="/images/illust1109.png" alt="inu" class="content_edit_image_2">
                              <div class="edit_content">編集</div>
                            </a><br />
                          </div>
                          <div class="content_delete_button">
                            <a href="/users/{{$user->id}}/contents/{{$content->id}}/delete" method="get">
                              <img src="/images/namagomi.png" alt="inu" class="content_edit_image">
                              <div class="edit_content">削除</div>
                            </a><br />
                          </div>
                          <div class="content_diagnosis_button" id="{{$content->id}}">
                            <a>
                              <img src="/images/613.png" alt="inu" class="content_edit_image">
                              <div class="edit_content">診断</div>
                            </a><br />
                          </div>
                        </div>
                      </div>
                    @endforeach
                    {{$contents->links()}}
                  @else
                    <div class="content_title">
                      日記はまだありません
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </body>
</html>