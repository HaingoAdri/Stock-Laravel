<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\Admin;

class AdminController extends Controller
{
    public function go_login(){
        return view('Login');
    }

    public function go_register(){
        return view('Register');
    }

    public function login_connect(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $admin =Admin::where('email',$email)
        ->where('mot_de_passe',$password)
        ->first();

        $nom = $admin->nom;

        if ($admin) {
            if ($admin->status == 0) {
                $admin = true;
                Session::put('admin', $admin);
                Session::put('nom',$nom);
                return redirect()->route('acceuil');
            } else {
                $admin = false;
                Session::put('admin', $admin);
                Session::put('nom',$nom);
                return redirect()->route('acceuil');
            }
        } else {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }
    }

    public function insert_admin(Request $request){
        $nom = $request->input('nom');
        $email = $request->input('email');
        $pass = $request->input('pass');
        $admin = Admin::create([
            'nom'=>$nom,
            'email'=>$email,
            'mot_de_passe'=>$pass
        ]);
        return redirect()->route('login');
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        return redirect()->route('login');
    }

}
