$(function(){
  $(".form_box").on('click',function(){
    var st_content = $(".new_content_in").attr("id");
    var st = $(".graph_in").attr("id");
    var edit_st = $(".edit_personal_in").attr("id");
    if(st_content == 1 || st_content == 2){
      $(".new_content_in").hide(300);
      setTimeout(() => {
        $(".new_content_page").empty();
      }, 400);
    }else{
      if(st == 1){
        $(".graph_in").hide(300);
        setTimeout(() => {
          $(".graph").empty();
        }, 400);
      }
      if(edit_st == 1){
        $(".edit_personal_in").hide(300);
        setTimeout(() => {
          $(".edit_personal").empty();
        }, 400);
      }
      if(st_content == 2){
        $(".new_content_in").hide(300);
        setTimeout(() => {
          $(".new_content_page").empty();
        }, 400);
      }
      var form_html = `
      <div class="new_content_in" id="1">
        <div class="close_button_new_content">
          <div class="close_text_new_content">
            ×
          </div>
        </div>
        <div class="main_new_content">
          <div class="main_box_new_content">
              <input type="text" class="title_form" name="title" placeholder="タイトル">
              <div class="form_box_content">
                  <textarea class="form_body" name="body" placeholder="メッセージ"></textarea>
              </div>
              <input type="submit" class="content_create_bottan" id="ontent_create_bottan" value="投  稿">
          </div>
        </div>
      </div>
      `
      $(".new_content_page").append(form_html);
      $(".new_content_in").show(300);      
    }
  })
  $(document).on('click', '.close_button_new_content', function(e){
    $(".new_content_in").hide(300);
    setTimeout(() => {
      $(".new_content_page").empty();
    }, 400);
  })
  $(document).on('click', '.content_create_bottan', function(e){
    var input_title = $(".title_form").val();
    var input_body = $(".form_body").val();
    var user_id = $(".user_name_box").attr("id");
    $.ajax({
      url: '/api/ajax/new_content',
      type: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'json',
      data: {
        user_id: user_id,
        title: input_title,
        body: input_body
      }, '_method': 'POST'
    })
    .done(function(data){
      alert(data.message)
      if(data.message == "投稿完了"){
        $(".new_content_in").hide(300);
        setTimeout(() => {
          $(".new_content_page").empty();
        }, 400);
        var append_html = `
                      <div class="content_main_box" id="nomver_${data.id}">
                          <div class="content_day">
                            投稿日
                            ${data.day}
                          </div>
                          <div class="content_title">
                            タイトル:
                            ${data.data.title}
                          </div>
                          <div class="content_body">
                          ${data.data.body}
                          </div>
                          <div class="setting_bottam">
                            <div class="creater_box">
                              <img src="/public/avatar/${data.user.icon}" alt="inu" class="icon_image_2">
                              <div class="creater_content">kaitoさんの投稿です</div>
                            </div>
                            <div class="content_edit_button">
                              <a href="/users/${data.data.user_id}/contents/${data.data.id}/edit" method="get">
                                <img src="/images/illust1109.png" alt="inu" class="content_edit_image">
                                <div class="edit_content">編集</div>
                              </a><br>
                            </div>
                            <div class="content_delete_button">
                              <a href="/users/${data.data.user_id}/contents/${data.data.id}/delete" method="get">
                                <img src="/images/namagomi.png" alt="inu" class="content_edit_image">
                                <div class="edit_content">削除</div>
                              </a><br>
                            </div>
                            <div class="content_diagnosis_button" id="${data.data.id}">
                              <a>
                                <img src="/images/613.png" alt="inu" class="content_edit_image">
                                <div class="edit_content">診断</div>
                              </a><br>
                            </div>
                          </div>
                        </div>
        `
        $(".main_zone").prepend(append_html);
      }
    })
    .fail(function(){
      alert("エラー")
    })
  })
})