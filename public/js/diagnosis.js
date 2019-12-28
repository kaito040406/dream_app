import './kuromoji.js';

$(function(){
  $(".content_diagnosis_button").on('click',function(){
    var diary_id = $(this).attr("id")
    $.ajax({
      url: '/api/ajax/get_json',
      type: 'get',
      dataType: 'json',
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
          $.ajax({
            url: '/api/ajax/get_uranai',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: {check_texts},
          })
          .done(function(dreams){
            var dream_data = [];
            var i = 0;
            var k = 0;
            var sum_point = 0;
            dreams.hit_dreams.forEach(function(dream){
              dream.forEach(function(d_d){
                dream_data[i] = d_d
                i=i+1
              })
            })
            var dream_data_set = new Set(dream_data)
            dream_data_set.forEach(function(point){
              k = k + 1;
              var suji = parseInt( point.level );
              sum_point = sum_point + suji;
            })
            var ave = sum_point / k;
            console.log(ave);
          })
        }
      })
    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  })
})