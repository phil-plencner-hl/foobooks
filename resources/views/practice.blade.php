<!doctype html>
<html lang='en'>
<head>

    <title>Practice</title>
    <meta charset='utf-8'>

</head>
<body>

<h1>Practice</h1>
@foreach($methods as $method)
    <a href='{{ str_replace('practice', '/practice/', $method) }}'> {{ $method }}</a><br>
@endforeach

</body>
</html>