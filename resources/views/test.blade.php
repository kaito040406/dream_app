<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>test</title>
  </head>
  <body>
      <div id="example"></div>
      <script src="{{mix('js/app.js')}}" ></script>
  </body>
</html>