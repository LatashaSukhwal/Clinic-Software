<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if($message=Session::get('success'))
    <span style="color:green">{{$message}}</span>
    @endif
    @if($message=Session::get('danger'))
    <span style="color:green">{{$danger}}</span>
    @endif
    @if(auth()->check())
    {{auth()->user()->name}}</br>
    <form method="post" action="{{url('signout')}}">
        @csrf
        <button type="submit">Signout</button>
</form>
@endif
    <!-- @if(!empty($sucess))
    <span style="color:green">{{$sucess}}</span>
    @endif
    @if(!empty($danger))
    <span style="color:red">{{$danger}}</span>
    @endif -->
    <table>
            <thead>
                <tr>
                <th>
      4              name
                </th>
                <th>
                    email
                </th>
                <th>
                    mobile
                </th>
                <th>
                    address
                </th>
                <th>
                    action
                </th>
</tr>    
            </thead>
<tbody>
    @foreach($clients as $client)
    <tr>
        <td>
            {{$client->name}}
        </td>
        <td>
            {{$client->email}}
        </td>
        <td>
            {{$client->mobile}}
        </td>
        <td>
            {{$client->client_address ? 
            $client->client_address->address : ''}}
        </td>
        <td>
            @if(!empty($client->image))
            <img src="{{ asset('storage/images/'.$client->image) }}"
            alt="">
            @else   
                <span>N/A</span>
            @endif
            </td>
            <td>
            <a href="{{ url('/edit/client/' .$client->id) }}">Edit</a>
            <form method="post" action="{{ url('/delete/client/' .$client->id) }}">
               @csrf
               @method('DELETE')
                <button type="submit"> Delete </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</body>
</html>