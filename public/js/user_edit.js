$(function(){
  $('.edit_profile_box').on('click', function(){
    var edit_st = $(".edit_personal_in").attr("id");
    var graph_st = $(".graph_in").attr("id");
    var st_content = $(".new_content_in").attr("id");
    console.log(edit_st)
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
      var user_edit_html = `
                            <div class="edit_personal_in" id = "1"> 
                              <div class="close_button_user_edit">
                                <div class="close_text_user_edit">
                                  ×
                                </div>
                              </div>
                              <div class="user_edit_form">
                                <form action="/users/1" method="post" id="user_edit_bottan" enctype="multipart/form-data">
                                  <input type="hidden" name="_token" value="BJ5mLgM6meZCIJZjXH4DLNFknVCAqVkglSVZvNI1">
                                  <div class="f_name_f">
                                    お名前
                                    <input type="text" class="form_name" name="name" placeholder="お名前" value="kaito">
                                  </div>
                                  <div class="f_birth_f">
                                    生年月日
                                    <input type="text" class="form_year" name="birth_year" placeholder="1993" value="non_data">年
                                    <input type="text" class="form_month" name="birth_month" placeholder="2" value="non_data">月
                                    <input type="text" class="form_day" name="birth_day" placeholder="5" value="non_data">日
                                  </div>
                                  <div class="f_intoro_f">
                                    一言紹介
                                    <input type="text" class="form_intro2" name="intro" value="はじめまして">
                                  </div>
                                  <label>
                                    <div class="f_icon_f">
                                      画像を選択してください<br>
                                      <div class="pic_box">
                                        <span class="filelabel" title="ファイルを選択">
                                          <img src="/images/camera.png" width="32" height="32" alt="＋画像">
                                        </span>
                                      </div>
                                      <input type="file" name="icon" class="file_bottan" id="file_bottan" value="noimage.png" accept=".jpg,.png">
                                    </div>
                                  </label>
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
  $(document).on('click', '.close_button_user_edit', function(e){
    $(".edit_personal_in").hide(300);
        setTimeout(() => {
          $(".edit_personal").empty();
        }, 400);
  })
})