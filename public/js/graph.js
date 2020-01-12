$(function(){
  $(".likes_box").on('click',function(){
    var st = $(".graph_in").attr("id");
    var st_content = $(".new_content_in").attr("id");
    var st_edit_content = $(".edit_content_in").attr("id");
    var edit_st = $(".edit_personal_in").attr("id");
    if(st == 1){
      $(".graph_in").hide(300);
      setTimeout(() => {
        $(".graph").empty();
      }, 400);
    }else{
      if(st_content == 1){
        $(".new_content_in").hide(300);
        setTimeout(() => {
          $(".new_content_page").empty();
        }, 400);
      }
      if (edit_st == 1){
        $(".edit_personal_in").hide(300);
          setTimeout(() => {
            $(".edit_personal").empty();
          }, 400);
      }
      if(st_edit_content == 2){
        $(".edit_content_in").hide(300);
        setTimeout(() => {
          $(".edit_content_page").empty();
        }, 400);
      }
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
                      <img src="/images/azarashi-shirokuro.png" alt="inu" class="per_image_azarashi">
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
                                    あなたの合計値は
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
          var windowWidth = $(window).width();
          if(windowWidth <= 481){
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
                      fontSize: 10  
                    },
                    scaleLabel: {                 
                      display: true,            
                      labelString: '',  
                      fontSize: 10,
                      labelString: 'クリックでグラフ変更ができます',                  
                  },
                  }],
                  yAxes:[{
                    ticks:{
                      min:-20,
                      max:20,
                      fontSize: 9  
                    },
                    scaleLabel: {   
                      display: true,               
                      labelString: '累計ポイント', 
                      fontSize: 10                  
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
                      fontSize: 10  
                    },
                    scaleLabel: {                 
                      display: true,            
                      labelString: '',  
                      fontSize: 10                
                  },
                  }],
                  xAxes: [{                  
                    display: true,             
                    barPercentage: 0.4,       
                    categoryPercentage: 0.4,     
                    scaleLabel: {             
                      display: true,           
                      fontSize: 10,
                      labelString: 'クリックでグラフ変更ができます',            
                    },
                    ticks: {
                        fontSize: 9          
                    },
                  }],
                  yAxes:[{
                    ticks:{
                      fontSize: 10  
                    },
                    scaleLabel: {   
                      display: true,               
                      labelString: 'ポイント', 
                      fontSize: 10                  
                    },
                  }],
                }
              }
            });
          }
          else{
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
        }
      })
      .fail(function(){
        console.log("メッセージ取得失敗")
      })
    }
    
  })
  $(document).on('click', '.close_button', function(e){
    $(".graph_in").hide(300);
    setTimeout(() => {
      $(".graph").empty();
    }, 400);
  })

  $(document).on('click', '#canvas', function(e){
    $(".line").hide(300);
    $(".bar").show(300);
  })

  $(document).on('click', '#canvas_bar', function(e){
    $(".bar").hide(300);
    $(".line").show(300);
  })

})