$(function(){
  $(".content_diagnosis_button").on('click',function(){
    id = $(this).attr("id")
    console.log(id)
    // $.ajax({
    //   url: '/groups/' + group_id + '/api/messages',
    //   type: 'get',
    //   dagaType: 'json',
    //   data: {id: last_message_id}
    // })
  })
})