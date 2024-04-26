<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function sigin_View()
    {
        return view('client/sigin');
    }
    public function sigin(Request $request)
    {
        $request->validate([
            'email'=>'required|max:255|email',
            'password'=>'required|max:255|min:8',
        ]);
        $user=User::where(['email'=>$request->input('email')])->first();
        if(empty($user))
        {
            return redirect()->back()->with('danger','please check your credentials and try again!');

        }
        if(Hash::check($request->input('password'),$user->password))
        {
            $credentials = $request->only('email','password');
            /* Auth Attempt code*/
            if(Auth::attempt($credentials))
            {
                return redirect('/list/client');
            }
            else{
                return redirect()->back()->withDanger('Error while Signning In');
            }
        }
        else
        {
            return redirect()->back()->with('danger','please check your credentials and try again!');

        }
        }
        public function signout(Request $request)
        {
            Session::flush();
            Auth::logout();
            return redirect('/sigin');
        }
        
    public function siginAPI(Request $request) 
    {
      $validator = Validator::make(
        $request->all(),[
            'email'=>'required|max:255|email',
            'password'=>'required|max:255|min:8'
        ]);
        if($validator->fails())
        {
            return response()->json(['message'=>$validator->errors(),'code'=>400],400);
        }
        if(!Auth::attempt(['email'=>$request->input('email'),
        'password'=>$request->input('password')]))
        {
            return response(['error_message'=>'incorrect details please try again','status'=>404],404);
        }
        $token=Auth::user()->createToken('MLSU')->accessToken;

        return response(['user'=>Auth::user(),'token'=>$token, 'status'=>200],200);
    }

    }
    

