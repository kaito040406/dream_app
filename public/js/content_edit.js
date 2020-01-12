$(function(){
  $(document).on('click', '.content_edit_button', function(e){
    var st_content = $(".new_content_in").attr("id");
    var st = $(".graph_in").attr("id");
    var edit_st = $(".edit_personal_in").attr("id");

    if(st_content == 2|| st_content == 1){
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
      if(st_content == 1){
        $(".new_content_in").hide(300);
      }
      var content_id = $(this).attr("id");
      var user_id = $(".user_name_box").attr("id");
      $.ajax({
        url: '/api/ajax/get_edit_content',
        type: 'get',
        dataType: 'json',
        data: {
          user_id: user_id,
          content_id: content_id,
        }
      })
      .done(function(data){

        if(data.message == "取得完了"){
          var edit_content_html = `
                                <div class="new_content_in" id="2">
                                  <div class="close_button_new_content">
                                    <div class="close_text_new_content">
                                      ×
                                    </div>
                                  </div>
                                  <div class="main_new_content" id="${content_id}">
                                    <div class="main_box_new_content">
                                        <input type="text" class="title_form" name="title" placeholder="タイトル" value="${data.data.title}">
                                        <div class="form_box_content">
                                            <textarea class="form_body" name="body" placeholder="メッセージ">${data.data.body}</textarea>
                                        </div>
                                        <input type="submit" class="content_edit_bottan" id="content_edit_bottan" value="編  集">
                                    </div>
                                  </div>
                                </div>
                                `
          $(".new_content_page").append(edit_content_html);
          $(".new_content_in").show(300); 

        }else{
          alert(data.message);
        }
      })
    }
  })

  $(document).on('click', '#content_edit_bottan', function(e){
    var input_title = $(".title_form").val();
    var input_body = $(".form_body").val();
    var user_id = $(".user_name_box").attr("id");
    var content_id = $(".main_new_content").attr("id");
    $.ajax({
      url: '/api/ajax/edit_content',
      type: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'json',
      data: {
        user_id: user_id,
        title: input_title,
        body: input_body,
        content_id: content_id
      }, '_method': 'POST'
    })
    .done(function(data){
      alert(data.message)
      if(data.message == "編集完了"){
        $(".new_content_in").hide(300);
        setTimeout(() => {
          $(".new_content_page").empty();
        }, 400);
        var updata_html = `
                        <div class="content_day">
                          投稿日
                          2020年01月09日
                        </div>
                        <div class="content_title" id="nomver_${data.id}">
                          タイトル:
                          ${data.title}
                        </div>
                        <div class="content_body" id="${data.id}">
                          ${data.body}
                        </div>
                        <div class="setting_bottam">
                          <div class="creater_box">
                            <img src="/public/avatar/${data.user.icon}" alt="inu" class="icon_image_2">
                            <div class="creater_content">kaitoさんの投稿</div>
                          </div>
                          <div class="content_edit_button" id="${data.id}">
                            <a>
                              <img src="/images/illust1109.png" alt="inu" class="content_edit_image_2">
                              <div class="edit_content">編集</div>
                            </a><br>
                          </div>
                          <div class="content_delete_button">
                            <a href="/users/1/contents/25/delete" method="get">
                              <img src="/images/namagomi.png" alt="inu" class="content_edit_image">
                              <div class="edit_content">削除</div>
                            </a><br>
                          </div>
                          <div class="content_diagnosis_button" id="${data.id}">
                            <a>
                              <img src="/images/613.png" alt="inu" class="content_edit_image">
                              <div class="edit_content">診断</div>
                            </a><br>
                          </div>
                        </div>
                        `

        $("#nomver_"+data.id).empty();
        $("#nomver_"+data.id).append(updata_html);
      }
      else{
        alert("エラー")
      }
    })
  })
})