<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>test view</div>
    @foreach($users as $user)
        <div>{{$user->name}}</div>  
        <div>{{$user->email}}</div> 
    @endforeach
</body>
</html>