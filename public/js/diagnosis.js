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
      var try_date = data.text[0].body;
      kuromoji.builder({ dicPath: "/dict" }).build(function(err, tokenizer){
        if(err){
          console.log(err);
        } else {
          var tokens = tokenizer.tokenize(try_date);
          var check_texts = [];
          tokens.forEach(function(token){
            // console.log(token.surface_form)
            var token_text = token.surface_form
            var regexp_kanji = /([\u{3005}\u{3007}\u{303b}\u{3400}-\u{9FFF}\u{F900}-\u{FAFF}\u{20000}-\u{2FFFF}][\u{E0100}-\u{E01EF}\u{FE00}-\u{FE02}]?)/mu;
            var regexp_katakana = /^[\u{30A1}-\u{30F6}]+$/mu;
            var check_kanji = regexp_kanji.test(token_text);
            var check_katakana = regexp_katakana.test(token_text);
            if(check_kanji == true){
              check_texts.push(token_text);
            }else{
              if(check_katakana == true){
                check_texts.push(token_text);
              }
            }
          })
          console.log(check_texts);
        }
      })
    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  })
})