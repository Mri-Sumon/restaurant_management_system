<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Mail\ForgetPassword;
use App\Models\TableBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AuthenticationController extends Controller
{
    public function authCheck(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);
        try {
            $Cradentials = $request->only('phone', 'password');
            if (Auth::guard('customer')->attempt($Cradentials)) {
                return redirect()->route('profile')->with('success', 'Login Successful');
            }
            return redirect()->back()->withInput($request->only('phone'))
                ->with('error', 'Phone No or Password was invalid.');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function customerLogout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customerLogin')->with('success', 'Logout Successful');
    }


    public function customerLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('profile');
        } else {
            return view('auth.customer_login');
        }
    }

    public function register()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('profile');
        } else {
            return view('auth.register');
        }
    }

    public function registrationStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'email'      => 'required|email',
                'phone'     => [
                    'required',
                    'unique:customers,phone',
                ],
                'password'   => 'required',
                'summation'  => 'required',
            ],
            [
                'first_name.required' => 'The first name field is mandatory.',

                'email.required'      => 'The email field is mandatory.',
                'email.email'         => 'Please provide a valid email address.',

                'phone.required'     => 'The phone number is required.',
                'phone.unique'       => 'The phone number is already taken.',

                'password.required'   => 'The password field is mandatory.',

                'summation.required'  => 'The captcha summation is required.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        if ((Session::get('first_code') + Session::get('second_code')) != $request->summation) {
            Session::flash('code_error', "Captcha code does not match.");
            return redirect()->back()->withInput();
        }

        $data = $request->all();

        $customer_code = DB::select("select code from customers where code = ?", [$request->code]);
        if (count($customer_code) > 0) {
            $data['code'] = generateCode('Customer', 'C');
        } else {
            $data['code'] = $request->code;
        }
        if ($request->last_name != '' && $request->last_name != null) {
            $data['name'] = $request->first_name . ' ' . $request->last_name;
        } else {
            $data['name'] = $request->first_name;
        }

        $data['password'] = Hash::make($request->password);
        $data['added_by'] = 1;
        $data['last_update_ip'] = request()->ip();

        try {
            $customer = Customer::create($data);
            $Cradentials = $request->only('phone', 'password');
            if (Auth::guard('customer')->attempt($Cradentials)) {
                return redirect()->route('profile')->with('success', 'Login Successful');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // ################ Profile #############
    public function profile()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customerLogin');
        } else {
            $data['bookings'] = TableBooking::where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

            $data['orders'] = Order::where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

            return view('auth.profile', $data);
        }
    }

    public function profileUpdate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'email'      => 'required|email',
                'phone'      => [
                    'required',
                    Rule::unique('customers', 'phone')->ignore(Auth::guard('customer')->user()->id),
                ],
            ],
            [
                'first_name.required' => 'The first name field is mandatory.',
                'email.required'      => 'The email field is mandatory.',
                'email.email'         => 'Please provide a valid email address.',
                'phone.required'      => 'The phone number is required.',
                'phone.unique'        => 'The phone number is already taken.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $customer = Customer::find(Auth::guard('customer')->user()->id);

        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Customer not authenticated']);
        }

        if ($request->hasFile('image')) {
            if ($customer->image && file_exists(public_path($customer->image))) {
                unlink(public_path($customer->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/customer'), $imageName);
            $data['image'] = 'uploads/customer/' . $imageName;
        }
        if ($request->last_name != '' && $request->last_name != null) {
            $data['name'] = $request->first_name . ' ' . $request->last_name;
        } else {
            $data['name'] = $request->first_name;
        }

        try {
            $customer->update($data);
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function profileAddressUpdate(Request $request)
    {
        $customer = Customer::find(Auth::guard('customer')->user()->id);

        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Customer not authenticated']);
        }
        $data = $request->all();

        try {
            $customer->update($data);
            return redirect()->back()->with('success', 'Profile Address Updated Successfully');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', $e->getMessage());
        }
    }
    // ############ Profile End #############

    public function password()
    {
        return view('passwordReset.forgotPassword');
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $has_password = Auth::guard('customer')->user()->password;
        if (Hash::check($request->old_password, $has_password)) {
            if (!Hash::check($request->password, $has_password)) {
                $customer = customer::find(Auth::guard('customer')->id());
                $customer->password = Hash::make($request->password);
                $customer->save();
                Auth::guard('customer')->logout();
                return redirect()->route('customerLogin')->with('success', 'Password Change Successful');
            } else {
                return redirect()->back()->withInput();
            }
        } else {
            return 'password dose not match';
        }
    }

    public function ForgotPassword(Request $request)
    {

        $request->validate([
            'email' => "required|email",
        ]);
        $token = Str::random(64);
        $checkcustomer = customer::where('email', $request->email)->first();

        if ($checkcustomer) {
            $checkEmail = DB::select('select email from password_resets where email = ?', [$request->email]);
            if (count($checkEmail) > 0) {
                DB::select('delete from password_resets where email = ?', [$request->email]);
            }
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::to($request->email)->send(new ForgetPassword($token));
            Session::flash('success', "Password reset link sent to the given email successfully");
        } else {
            Session::flash('error', "Email does not found");
        }
        return redirect()->to(route('password'));
    }

    public function ResetPassword($token)
    {
        return view('passwordReset.newPassword', compact('token'));
    }

    public function ResetPass(Request $request)
    {
        $request->validate([
            'password' => "required",
            'password_confirmation' => 'required',
        ]);
        // return $request;
        $updatePassword = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();
        // $updatePassword = DB::select("SELECT * FROM password_resets WHERE `email` = ? AND `token` = ?", [$request->email, $request->token]);
        if (empty($updatePassword)) {
            return redirect("/reset-password/" . $request->token)->with('error', 'Invalid');
        }
        customer::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect()->to(route('home'))->with('success', 'password reset successfull');
    }
}
