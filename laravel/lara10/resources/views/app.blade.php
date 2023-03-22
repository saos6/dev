<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style type="text/css">
    body {
        font-family: "Hiragino Kaku Gothic ProN","Hiragino Sans",Meiryo,sans-serif;
        margin-top: 10px !important;
    }
    </style>
    <title>Laravel</title>
  </head>
  <body>
    <div class="container">
    <h1 style="font-size:1.75rem;">Laravelシステム</h1>
        @yield('content')
        <div><a href="{{ url('./dashboard') }}">dashboard</a></div>
    </div>
  </body>
</html>