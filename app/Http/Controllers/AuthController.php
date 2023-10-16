<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{
       /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('frontend.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('frontend.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false;
        // config/session.php set 'expire_on_close' => true,
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withErrors('You have entered invalid credentials!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);

        $data = $request->all();
        $user = $this->create($data);

        return redirect("/login")->withSuccess('You have successfully registered!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('auth.dashboard')->with('user',$user);
        }
        return redirect("login")->withErrors('You do not have access!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login')->withSuccess('You have successfully loged out!');

  
    }
}
