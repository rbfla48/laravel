<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisteredUserController extends Controller{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $user = new User;
        
        $userArr['name'] = $request->input('name');
        $userArr['phone'] = $request->phone[0].$request->phone[1].$request->phone[2];
        //$user['email'] = $request->input('email');
        $userArr['zip_code'] = $request->input('zip_code');
        $userArr['address'] = $request->input('address1');
        $userArr['address_detail'] = $request->input('address2');
        $userArr['password'] = Hash::make($request->input('password'));
        $userArr['user_type'] = "client";
        $userArr['user_level'] = 10;
    
        //$user->save();
        $user->where('email',$request->input('email'))->update($userArr);

        //event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }

    public function verificationCodeCheck(Request $request){
        $code = $request->verification_code;
        $email = $request->email;
        $nowTime = Carbon::now();

        $oldCode = User::select('verification_code')->where('email','=',$email)->first();

        if($oldCode == $code){
            $userArr['emil_verfication'] = $nowTime;
            User::where('email',$request->input('email'))->update($userArr);

            $respon['code'] = 0000;
            $respon['msg'] = "success";
        }else{
            $respon['code'] = 0001;
            $respon['msg'] = "false";
        }

        return $respon;
    }
}
