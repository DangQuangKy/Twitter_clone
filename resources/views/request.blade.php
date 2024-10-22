<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('req.submit') }}" method="POST">
        @csrf
        <input type="text" name="test" value="{{ old('test') }}">
        
        <div style="color: red;">
            {{ $errors->first('test') ?? 'Trường này là bắt buộc.' }}
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>