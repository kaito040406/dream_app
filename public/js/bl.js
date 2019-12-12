$(function(){
  $('.content_create_bottan').on('click', function(){
    var title_value = $('input[name="title"]').val();
    var body_value = $('textarea[name="body"]').val();
    if(title_value == "" || body_value == ""){
      alert('タイトルと本文を入力してください');
      return false;
    }
  })
})


  

  
