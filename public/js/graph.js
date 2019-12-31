$(function(){
  $(".likes_box").on('click',function(){
    var user_id = $(".user_name_box").attr("id");
    var html = `<div class="graph_in">
              <div style="width:100%">
                  <canvas id="canvas"></canvas>
              </div>
            </div>` 
    // console.log(html)
    $('.graph').append(html);
    console.log(user_id)
    $.ajax({
      url: '/api/ajax/graph',
      type: 'get',
      dataType: 'json',
      data: {id: user_id}
    })
    .done(function(data){
      console.log(data)
    })
    .fail(function(){
      console.log("メッセージ取得失敗")
    })
  //   function drawCart() {
  //     var ctx = document.getElementById('canvas').getContext('2d');
  //     window.myChart = new Chart(ctx{
  //       type: 'bar',
  //       data: {
  //         labels: [{
  //           data: [],

  //         }]
  //       }
  //     })
  //   }
  })
})