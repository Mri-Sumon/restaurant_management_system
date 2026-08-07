<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showUserLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ], [
            'login.required'    => 'Username or Email is required',
            'password.required' => 'Password is required',
        ]);

        try {

            // Detect whether the input is email or username
            $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
                ? 'email'
                : 'username';

            // Find user
            $user = User::where($field, $request->login)->first();

            if (!$user) {
                return send_error("Unauthorized", [
                    'login' => 'User not found'
                ], 401);
            }

            if ($user->status == 'p') {
                return send_error("Unauthorized", [
                    'login' => 'User Deactive'
                ], 401);
            }

            // Attempt login
            if (Auth::attempt([
                $field => $request->login,
                'password' => $request->password
            ])) {

                UserActivity::create([
                    'user_id'    => $user->id,
                    'page_name'  => 'Dashboard',
                    'login_time' => Carbon::now(),
                    'ip_address' => $request->ip(),
                ]);

                Session::flash('success', 'Login successfully');

                return response()->json([
                    'status'  => true,
                    'message' => 'Successfully Login',
                    'user'    => Auth::user(),
                ], 200);
            }

            return send_error("Unauthorized", [
                'login' => 'Username/Email or Password is incorrect'
            ], 401);
        } catch (\Throwable $th) {
            return send_error('Something went wrong', $th->getMessage(), 500);
        }
    }
}
