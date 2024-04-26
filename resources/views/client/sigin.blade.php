<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ url('sigin') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" placeholder="Please enter your email"></br>
    
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>password</label>
        <input type="password" name="password" placeholder="Please enter your password"></br>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <button type="submit">Sigin</button>
</form>
</body>
</html>