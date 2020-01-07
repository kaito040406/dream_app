$(function(){
  $(".form_box").on('click',function(){
    var form_html = `
                    <div class="new_content_in">
                      <div class="close_button_new_content">
                        <div class="close_text_new_content">
                          ×
                        </div>
                      </div>
                      <div class="main_new_content">
                        <div class="main_box_new_content">
                            <input type="hidden" name="_token" value="Am7pcTcpqVoVbw1KNjSs4rm5OaSjBFNw9qlP63Gk">
                            <input type="hidden" name="user_id" value="1">
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
  })
  $(document).on('click', '.close_button_new_content', function(e){
    $("new_content_in").hide(300);
    setTimeout(() => {
      $(".new_content_page").empty();
    }, 400);
  })
})