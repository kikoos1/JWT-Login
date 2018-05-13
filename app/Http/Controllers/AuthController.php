<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Socialite;

class AuthController extends Controller
{
    //

    public function Register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required'
        ]);
        $confirmCode = str_random(30);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->isconfirm = 0;
        $user->confirmCode = $confirmCode;
        $user->save();
        Mail::send('mail', ['code'=>$confirmCode], function($message) {
            $message->to(request('email'),request('name'))
                ->subject('Verify your email address');
        });
        return response()->json([
            'message'=>'Registration successful',
            'type' => 'success'
        ]);

    }
    public function Login(){
        $validateData = request()->validate([
           'email' =>'required|email',
           'password'=>'required'
        ]);
        $credentials = request()->only('email','password');
        if(! $token = JWTAuth::attempt($credentials)){
            return response()->json([
                'message'=>'Invalid credentials',
                'type'=>'error'
            ]);
        }
        return response()->json([
            'message'=>'Loggin',
            'type'=>'success'
        ])->header('Authorization', $token);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    public function ValidateUser($code){
        $user = User::where('confirmCode',$code)->first();
        $user->isconfirm = 1;
        $user->save();
        return redirect('/#/dashboard');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        $token = JWTAuth::fromUser($authUser);
        return response()->json([
            'message'=>'Loggin',
            'type'=>'success'
        ])->header('Authorization', $token);

    }
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
       $users = new User;
        $users->email=$user->email;
        $users->name=$user->name;
        $users->provider_id = $user->id;
        $users->provider = $provider;
        $users->save();
        return $users;
    }

}
