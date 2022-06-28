<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/data" method="post">
    @csrf
    <input type="email" name="email" id="">
    <input type="submit" value="send">
    </form>
</body>
</html>