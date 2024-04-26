<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('client_address')->get();
        // dd($clients);
        return view('client/index')->withClients($clients);
    }
//list display in json format in api
    public function ajax_index()
    {
        $clients = Client::with('client_address')->get();
        return response()->json(array($clients));
    
    }
    
    public function create()
    {
        return view('client/create');
    }

    public function ajax_create()
    {
        return view('client/create');
        return response()->json(array('status'=>250,'message'=>'client created successfully'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required|max:255|min:10'
        ],
        [
            'name.required' => 'Please enter your name',
            'name.max'  => 'Name must not exceed 255 characters',
        ]);
        
        $image="";
        if($request->hasFile('image'))
        {
            
            $extension=$request->file('image')->extension();
            $file = $request->file('image');
            $fileNameString=(string) str::uuid();
            $image=$fileNameString.time().".". $extension;
            $path=Storage::putFileAs('public/images',$file,$image);
         }


        $info = $request->all();

        // Client creation in database
        $client = Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile'  => $request->input('mobile'),
            'image'  =>$image
            
        ]);

        // Client address creation in database
        Address::where('client_id')->update([
            'address'=> $request->input('address'),
        ]);

       return redirect()->back()->with('success',"client updated successfully");
    }

//client ajax_store function
    public function ajax_store(Request $request)
    {
        $validator=Validator::make(
        $request->all(),[
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required|max:255|min:10'
        ],
        [
            'name.required' => 'Please enter your name',
            'name.max'  => 'Name must not exceed 255 characters',
        ]);
        if($validator->fails())
        {
        return response()->json(['message'=>$validator->errors(),'code'=>400],400);
        }
        
        $image="";
        if($request->hasFile('image'))
        {
            
            $extension=$request->file('image')->extension();
            $file = $request->file('image');
            $fileNameString=(string) str::uuid();
            $image=$fileNameString.time().".". $extension;
            $path=Storage::putFileAs('public/images',$file,$image);
         }


        $info = $request->all();

        // Client creation in database
        $client = Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile'  => $request->input('mobile'),
            'image'  =>$image
            
        ]);
       // Client address creation in database
        Address::create([
            'client_id'=>$client->id,
            'address'=> $request->input('address'),
        ]);

       return response()->json(array('status'=>200,'message'=>"client created successfully"));
    }




    //edit function 
    public function edit($id=null)
    {
        if($id==null)
        {
            return redirect()->back()->with('danger','please select the client');
        }
        $client=Client::where('id',$id)->with('client_address')->first();
        return view('client/edit')->withClient($client);
    }

    //update function
    public function update(Request $request,$id = null)
    {
        if($id==null)
        {
            return redirect()->back()->with('danger','please select a client');
        }
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required|max:255|min:10'
        ],
        [
            'name.required' => 'Please enter your name',
            'name.max'  => 'Name must not exceed 255 characters',
        ]);

        $client=Client::where('id',$id)->update([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' =>$request->input('mobile'),
        ]);
        Address::where('client_id',$id)->update([
        'address' =>$request->input('address'),]);
        return redirect()->back()->with('success',"Client updated successfully");
    }

    //ajax_update function
    public function ajax_update(Request $request,$id = null)
    {
        if($id==null)
        {
            return redirect()->back()->with('danger','please select a client');
        }
        $validator=Validator::make(
        $request->all(),[
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required|max:255|min:10'
        ],
        [
            'name.required' => 'Please enter your name',
            'name.max'  => 'Name must not exceed 255 characters',
        ]);

        if($validator->fails())
        {
        return response()->json(['message'=>$validator->errors(),'code'=>400],400);
        }
        $client=Client::where('id',$id)->update([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' =>$request->input('mobile'),
        ]);
        Address::where('client_id',$id)->update([
        'address' =>$request->input('address'),]);

        return response()->json(array('status'=>250,'message'=>"Client updated successfully"));
    }



//delete function
    public function delete($id=null)
{
    if($id==null){
        return redirect()->back()->with('danger','please select a client');
    }
    $client=client::where('id',$id)->first();
    if(empty($client))
    {
        return redirect()->back()->with('danger',"Client not found");
    }
    $client::where('id',$id)->delete();
    Address::where('client_id',$id)->delete();
    return redirect()->back()->with('success',"Client deleted successfully");
}        

//ajax_delete function 

public function ajax_delete($id=null)
{
    if($id==null){
        return redirect()->back()->with('danger','please select a client');
    }
    $client=client::where('id',$id)->first();
    if(empty($client))
    {
        return redirect()->back()->with('danger',"Client not found");
    }
    $client::where('id',$id)->delete();
    Address::where('client_id',$id)->delete();
    return response()->json(array('status'=>250,'message'=>"Client deleted successfully"));
}        


public function store(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'Staff_name' => 'required|max:255',
        'Designation' => 'required|max:255',
        'Address' => 'required|max:255',
        'Email' => 'required|email|unique:users',
        'Contact' => 'required|digits:10|numeric',
        'gender' => 'required',
        'image' => 'image|required',
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors(),
        ];
        return response()->json($response, 400);
    }

    // Upload image
  if ($request->hasFile('image')) {
     $image = $request->file('image');
     //$originalName = $image->getClientOriginalName();
     $originalName = time().'_'.$image->getClientOriginalName();
     $image->move(public_path('images'), $originalName);  
 }

    
    // // Create staff member
    $input = $request->all();
    $input['image'] = $originalName ?? null; // Assign the image name if it exists

    $user = Staff::create($input);

    // Prepare response
    $success = [
        'Staff_name' => $user->Staff_name,
        'Designation' => $user->Designation,
        'Address' => $user->Address,
        'Email' => $user->Email,
        'Contact' => $user->Contact,
        'gender' => $user->gender,
        'image' => $user->image,
    ];

    $response = [
        'success' => true,
        'data' => $success,
        'message' => 'Staff added successfully',
    ];

    return response()->json($response, 200);
}



}

