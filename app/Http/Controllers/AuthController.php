<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Auth;
use App\Http\Requests\AuthRequest;;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller{
    public function applyRegistration(Request $request){

        $auth = new Auth();
        $auth->email = $request->email;
        $auth->password = $request->password;
//        $id = $auth->where('email', $request->input('email'))->value('id');
        $auth->save();

        }

    public function getCookie(){
        return redirect(route('home'))
            ->withCookie(Cookie::forget('email'))
            ->withCookie(Cookie::forget('id'))
            ->withCookie(Cookie::forget('password')) ;

    }

    public function loginIn(Request $request){
        $auth = new Auth();
        $p = $request->password;
        $m = $request->email;
        if ($auth->where('password', $p)->first()
            &&
            $auth->where('email',$m)->first()){

            $id = $auth->where('email', $m)->value('id');

            return ['id'=>$id, 'email'=>$m];

        // Cookie::queue('password', $request->password);
        // Cookie::queue('email', $request->email);
        // Cookie::queue('id', $id);
        // return redirect(route('home'))->with('success', 'Вы успешно вошли');

        }else{
            // return redirect()->route('login')->with('failed', 'Вы ввели неправильные Email или пароль');
            return'No';
        }
    }

    public function checkEmail(Request $request){
        $auth = new Auth();
        $email = $auth->where('email', $request->email)->first();
        if ($email){
            return 'false';
        }else{
            return 'true';
        }

    }

    
}
