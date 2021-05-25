<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use Inertia\Inertia;

class AuthController extends Controller
{
    public function index(){
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => FALSE
        ]);
    }

    public function dashboard(){
        return Inertia::render('investor.index');
    }

    public function VerificationNotice(){
        return Inertia::render('Auth/VerifyEmail');
    }

    public function VerificationVerify(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect()->route('investor.index');
    }

    public function VerificationNotification(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
