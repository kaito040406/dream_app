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
      console.log(data.text[0].body);
      var try_date = data.text[0].body
      kuromoji.builder({ dicPath: "/dict" }).build(function(err, tokenizer){
        if(err){
          console.log(err);
        } else {
          var tokens = tokenizer.tokenize(try_date);
          console.log(tokens);
        }
      });
    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  })
})