import './kuromoji.js';

$(function(){
  $(".content_diagnosis_button").on('click',function(){
    var st = $(".graph_in").attr("id");
    if(st == 1){

    }else{
      var load_html = `
                      <div class="graph_in" id = "1">
                        <div class="load_text">
                          計算中だよ!!
                        </div>
                      </div>
                      `
      $(".load").append(load_html);
      $(".graph_in").show(300);
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
              if(dreams.message == "meny"){
                dreams.hit_dreams.forEach(function(dream){
                  if(dream.length == null){
                    dream_data[i] = dream
                    i=i+1
                  }
                })
              }else{
                if(dreams.message == "solo"){
                  dreams.hit_dreams.forEach(function(dream){
                    dream.forEach(function(d_d){
                      dream_data[i] = d_d
                      i=i+1
                    })
                  })
                }
              }
              console.log(dream_data)
              var dream_data_set = new Set(dream_data)
              dream_data_set.forEach(function(point){
                k = k + 1;
                var suji = parseInt( point.level );
                sum_point = sum_point + suji;
              })
              if(k == 0){
                var ave = 0;
              }else{
                if(dream_data[0] == "no_data"){
                  var ave = 0;
                }else{
                  var ave = sum_point / k;
                }
              }
              $.ajax({
                url: '/api/ajax/make_graph',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: {
                  content_id: diary_id,
                  ave:  ave
                }, '_method': 'POST'
              })
              .done(function(data){
                $(".graph_in").hide(300);
                  setTimeout(() => {
                    $(".load").empty();
                  }, 400);

                var user_id = $(".user_name_box").attr("id");
                var html = `<div class="graph_in" id="1">
                              <div class="close_button">
                                <div class="close_text">
                                  ×
                                </div>
                                <div class="open_data">
                                </div>
                              </div>
                              <div class="graph_box">
                                <div class="line">
                                  <div style="width:75%">
                                    <canvas id="canvas"></canvas>
                                  </div>
                                </div>
                                <div class="bar">
                                  <div style="width:75%">
                                    <canvas id="canvas_bar"></canvas>
                                  </div>
                                </div>
                              </div>
                              <div class="azarashi_text_box">
                                <div class="azarashi_text">
                                  合計値がプラスになっているといいことが起こる夢だよ<br>
                                  マイナスになるとやばいよ！！！
                                </div>
                              </div>
                              <div class="azarashi_box">
                                <img src="/images/azarashi-shirokuro.png" alt="inu" class="per_image" width="130" height="130">
                              </div>
                            </div>
                            ` 
                $('.graph').append(html);
                $.ajax({
                  url: '/api/ajax/graph',
                  type: 'get',
                  dataType: 'json',
                  data: {id: user_id}
                })
                .done(function(datas){
                  // console.log(datas.data)
                  var create_day=[];
                  var point = [];
                  var day_point = [];
                  var i = 0
                  datas.data.forEach(function(point_data){
                    var change_data = point_data.day.slice( 0, -9 )
                    var chage_data2 = change_data.slice(5, 12)
                    create_day[i] = chage_data2
                    day_point[i] = Number(point_data.element_point)
                    if(i == 0){
                      point[i] = Number(point_data.element_point)
                    }
                    else{
                      point[i] = point[i-1] + Number(point_data.element_point)
                    }
                    i = i + 1
                  })
                  if(datas.message == "取得成功"){
                    var day_point_count = day_point.length
                    if(day_point_count >= 7){
                      var day_point_last = day_point.slice(day_point_count-7, day_point_count)
                      var sum_point_last = point.slice(day_point_count-7, day_point_count)
                      var day_create_last = create_day.slice(day_point_count-7, day_point_count)
                    }else{
                      var day_point_last = day_point
                      var sum_point_last = point
                      var day_create_last = create_day
                    }
                    
                    var sum_data  = point.slice(-1)[0] * 10;
                    sum_data = Math.round(sum_data);
                    sum_data = sum_data / 10;
                    var open_data_html = `
                                          <div class="open_text_data">
                                            <div class="open_text_introduction">
                                              あたなの合計値は
                                            </div>
                                            <div class="open_text_data_text">
                                              ${sum_data}
                                            <div>
                                          </div>
                                          `
                    $('.open_data').append(open_data_html);
                    $(".graph_in").show(300);
                    var ctx = document.getElementById('canvas').getContext('2d');
                    var ctx_bar = document.getElementById('canvas_bar').getContext('2d');
                    window.myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: day_create_last,
                        datasets:[{
                          label: '累計データ',
                          data: sum_point_last,
                          backgroundColor: 'rgba(60, 160, 220, 0.3)',
                          borderColor: '#FF9900',
                          fill: false,
                          borderDash: [8, 2],
                        }],
                      },
                      options: {
                        legend: {
                          display: false
                        },
                        scales:{
                          xAxes:[{
                            ticks:{
                              min:0,
                              fontSize: 20  
                            },
                            scaleLabel: {                 
                              display: true,            
                              labelString: '',  
                              fontSize: 20,
                              labelString: 'クリックでグラフ変更ができます',                  
                          },
                          }],
                          yAxes:[{
                            ticks:{
                              min:-20,
                              max:20,
                              fontSize: 20  
                            },
                            scaleLabel: {   
                              display: true,               
                              labelString: '累計ポイント', 
                              fontSize: 20                  
                          },
                          }],
                        }
                      }
                    });
          
                    
                    window.myChart = new Chart(ctx_bar, {
                      type: 'bar',
                      data: {
                        labels: day_create_last,
                        datasets:[{
                          label: '累計データ',
                          data: day_point_last,
                          backgroundColor: 'rgba(60, 160, 220, 0.8)',
                          borderColor: '#000080',
                        }],
                      },
                      options: {
                        legend: {
                          display: false
                        },
                        scales:{
                          xAxes:[{
                            ticks:{
                              min:0,
                              fontSize: 20  
                            },
                            scaleLabel: {                 
                              display: true,            
                              labelString: '',  
                              fontSize: 20                
                          },
                          }],
                          xAxes: [{                  
                            display: true,             
                            barPercentage: 0.4,       
                            categoryPercentage: 0.4,     
                            scaleLabel: {             
                               display: true,           
                               fontSize: 20,
                               labelString: 'クリックでグラフ変更ができます',            
                            },
                            ticks: {
                                fontSize: 18          
                            },
                          }],
                          yAxes:[{
                            ticks:{
                              fontSize: 20  
                            },
                            scaleLabel: {   
                              display: true,               
                              labelString: 'ポイント', 
                              fontSize: 20                  
                            },
                          }],
                        }
                      }
                    });
                    
                  }
                })
                .fail(function(){
                  console.log("メッセージ取得失敗")
                })

                
              })
            })
          }
        })
      })
      .fail(function(){
        console.log("メッセージ取得失敗")
      })
    }
  })
})