$(function(){
  $('.edit_profile_box').on('click', function(){
    var edit_st = $(".edit_personal_in").attr("id");
    var graph_st = $(".graph_in").attr("id");
    var st_content = $(".new_content_in").attr("id");
    var user_id = $(".user_name_box").attr("id");
  
    if (edit_st == 1){
      $(".edit_personal_in").hide(300);
        setTimeout(() => {
          $(".edit_personal").empty();
        }, 400);
    }else{
      if(graph_st == 1){
        $(".graph_in").hide(300);
        setTimeout(() => {
          $(".graph").empty();
        }, 400);
      }
      if(st_content == 1){
        $(".new_content_in").hide(300);
        setTimeout(() => {
          $(".new_content_page").empty();
        }, 400);
      }
      $.ajax({
        url: '/api/ajax/get_user',
        type: 'get',
        dataType: 'json',
        data: {id: user_id}
      })
      .done(function(user_data){
        if(user_data.message == "エラー"){
          alert(user_data.message);
        } else{
          var token = $('meta[name="csrf-token"]').attr('content');
          var user_edit_html = `
                                <div class="edit_personal_in" id="1"> 
                                  <div class="close_button_user_edit">
                                    <div class="close_text_user_edit">
                                      ×
                                    </div>
                                  </div>
                                  <div class="user_edit_form">
                                    <form action="/users/${user_data.user.id}" method="post" id="user_edit_bottan" enctype="multipart/form-data">
                                      <input type="hidden" name="_token" value="${token}">
                                      <div class="f_name_f">
                                        お名前
                                        <input type="text" class="form_name" name="name" placeholder="お名前" value="${user_data.user.name}">
                                      </div>
                                      <div class="f_birth_f">
                                        生年月日
                                        <input type="text" class="form_year" name="birth_year" placeholder="1993" value="${user_data.user.birth_year}">年
                                        <input type="text" class="form_month" name="birth_month" placeholder="2" value="${user_data.user.birth_month}">月
                                        <input type="text" class="form_day" name="birth_day" placeholder="5" value="${user_data.user.birth_day}">日
                                      </div>
                                      <div class="f_intoro_f">
                                        一言紹介
                                        <input type="text" class="form_intro2" name="intro" value="${user_data.user.intro}">
                                      </div>
                                      <div class="picture_box">
                                        <label>
                                          <div class="f_icon_f">
                                            画像を選択してください<br>
                                            <div class="pic_box">
                                              <span class="filelabel" title="ファイルを選択">
                                                <img src="/images/camera.png" width="32" height="32" alt="＋画像">
                                              </span>
                                            </div>
                                            <input type="file" name="icon" class="file_bottan" id="file_bottan" value="${user_data.user.icon}" accept=".jpg,.png">
                                          </div>
                                        </label>
                                        <div class="edit_icon_box">
                                          <img src="/public/avatar/${user_data.user.icon}" alt="inu" class="edit_icon">
                                        </div>
                                      </div>
                                      <div class="f_submit_f">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="submit" class="create" value="編  集">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              `
          $(".edit_personal").append(user_edit_html);
          $(".edit_personal_in").show(300); 
        }
      })
      .fail(function(){
        alert("エラー")
      });
    }
  })
  $(document).on('click', '.close_button_user_edit', function(e){
    $(".edit_personal_in").hide(300);
        setTimeout(() => {
          $(".edit_personal").empty();
        }, 400);
  })
  $(document).on('change','input[id=file_bottan]', function(){
    var select_image = $(this).prop('files')[0];
    var reader = new FileReader();
    // console.log(reader.result);
    // console.log(reader);
    if(select_image.type.indexOf("image") < 0){
      return false;
    }
    reader.onload = function() {
      var append_html = `<img src="` + reader.result +`" alt="inu" class="edit_icon">`;
      $(".edit_icon_box").empty();
      $(".edit_icon_box").append(append_html);
    }
    // console.log(render.readyState)
    

    reader.readAsDataURL(select_image); 
  })
})