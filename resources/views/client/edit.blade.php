<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Client</title>
</head>
<body>
    <form method="post" action="{{ url('update/client/'.$client->id) }}">
        @csrf
        @method('PUT')
        <label>Email</label>
        <input type="email" name="email" placeholder="Please enter your email
         address" value="{{ $client->email }}"></br>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Name</label>
        <input type="text" name="name" placeholder="Please enter your name" 
        value="{{ $client->name }}"></br>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Mobile</label>
        <input type="text" name="mobile" placeholder="Please enter your mobile" 
        value="{{ $client->mobile }}"></br>
        @error('mobile')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <label>Address</label>
        <input type="text" name="address" placeholder="Please enter your address" 
        value="{{ $client->address }}"></br>
        @error('address')
            <div class="alert alert-danger">{{ $message }}</div></br>
        @enderror
        <button type="submit">Update</button>
    </form>
</body>
</html>