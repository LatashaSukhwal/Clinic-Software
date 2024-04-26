<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ url('create/client') }}" enctype="multipart/form-data">
        @csrf
        <label>Email</label>
        <input type="email" name="email" placeholder="Please enter your email address" value="{{ old('email') }}"></br>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Name</label>
        <input type="text" name="name" placeholder="Please enter your name" value="{{ old('name') }}"></br>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Mobile</label>
        <input type="text" name="mobile" placeholder="Please enter your mobile" value="{{ old('mobile') }}"></br>
        @error('mobile')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Address</label>
        <input type="text" name="address" placeholder="Please enter your address" value="{{ old('address') }}"></br>
        @error('address')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Image</label>
        <input type="file" name="image"></br> 
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <button type="submit">Save</button>
    </form>
</body>
</html>