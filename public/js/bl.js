$(function(){
  $('#content_create_bottan').on('submit', function(e){
    e.preventDefault();
    var title_value = $(".title_form").attr("value")
    var body_value = $('textarea[name="body"]').val();
    if(title_value == "" || body_value == ""){
      alert('タイトルと本文を入力してください');
    }
  })
})

  
