<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use  App\User;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
           
            $user           = new User;
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $plainPassword  = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            Mail::to($user->email)
                ->send(new WelcomeEmail($user->name));
            //return successful response
            $errors = [];
            $errors[] = 'Usuario Cadastrado';
            return view('auth.login')->with(compact('errors'));

            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
               $errors[] = 'Falha do Cadastramento';
                return view('auth.login')->with(compact('errors'));
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {

                $errors = [];
                $errors[] = 'Credenciais Invalidas';
                return view('auth.login')->with(compact('errors'));

            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::find(Auth::id());
        $user->remember_token = $token;
        $user->save(); 

        $this->respondWithToken($token);
  
        return redirect()->route('inicio', ['id' => Auth::id().'?'.'token='.$token]);

        return $this->respondWithToken($token);
    }

    public function index(){

        return view ('auth.login');

    }

    public function logout() {


        $user = User::find(Auth::id());

        if ($user == NULL)  return view ('auth.login');


        $token = $user->remember_token;

        
        Auth::logout($token);    


        return view ('auth.login');





    }
}
