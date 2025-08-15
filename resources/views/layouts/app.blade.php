<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Desafío Woo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  @yield('content')
</body>
</html>
