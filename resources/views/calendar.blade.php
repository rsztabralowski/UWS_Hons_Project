<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
</head>
<body>
    @auth
        <h1>You are logged in</h1>
    @else 
        <h1>You are a guest</h1>
    @endauth
</body>
</html>