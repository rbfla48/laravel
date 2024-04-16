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
        
        $user->name = $request->input('name');
        $user->phone = $request->phone[0].$request->phone[1].$request->phone[2];
        $user->email = $request->input('email');
        $user->zip_code = $request->input('zip_code');
        $user->address = $request->input('address1');
        $user->address_detail = $request->input('address2');
        $user->password = Hash::make($request->input('password'));
        $user->user_type = "client";
        $user->user_level = 10;
    
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
