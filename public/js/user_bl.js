$(function(){
  $('.create').on('click', function(){
    var name_value = $('input[name="name"]').val()
    var year_value = $('input[name="birth_year"]').val()
    var month_value = $('input[name="birth_month"]').val()
    var day_value = $('input[name="birth_day"]').val()
    var intro_value = $('input[name="intro"]').val()
    if(name_value == ""){
      alert('名前を入力してください');
      return false;
    }
    if(year_value == ""){
      alert('誕生日を入力してください');
      return false;
    }
    if(month_value == ""){
      alert('誕生日を入力してください');
      return false;
    }
    if(day_value == ""){
      alert('誕生日を入力してください');
      return false;
    }
    if(intro_value == ""){
      alert('一言紹介を入力してください');
      return false;
    }
  })
})