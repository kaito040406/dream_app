$(function(){
  $(".form_box").on('click',function(){
    var st_content = $(".new_content_in").attr("id");
    var st = $(".graph_in").attr("id");
    if(st_content == 1){
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
    console.log(input_title);
    console.log(input_body);
  })
})