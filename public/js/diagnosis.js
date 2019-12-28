import './kuromoji.js';

$(function(){
  $(".content_diagnosis_button").on('click',function(){
    var diary_id = $(this).attr("id")
    $.ajax({
      url: '/api/ajax/get_json',
      type: 'get',
      dagaType: 'json',
      data: {id: diary_id}
    })
    .done(function(data){
      console.log(data.text[0].body)

    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  })
})