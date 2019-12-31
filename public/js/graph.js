
$(function(){
  $(".likes_box").on('click',function(){
    var user_id = $(".user_name_box").attr("id");
    var html = `<div class="graph_in">
                  <div class="close_button">
                  </div>
                  <div class=graph_box>
                    <div style="width:80%">
                        <canvas id="canvas"></canvas>
                    </div>
                  </div>
                </div>` 
    // console.log(html)
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
      var i = 0
      datas.data.forEach(function(point_data){
        var change_data = point_data.created_at.slice( 0, -9 )
        create_day[i] = change_data
        if(i == 0){
          point[i] = Number(point_data.element_point)
        }
        else{
          point[i] = point[i-1] + Number(point_data.element_point)
        }
        i = i + 1
      })
      console.log(create_day)
      console.log(point)
      if(datas.message == "取得成功"){
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: create_day,
            datasets:[{
              label: '累計データ',
              data: point,
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
                  fontSize: 20                
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
      }
    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  })
})