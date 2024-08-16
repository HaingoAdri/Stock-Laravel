<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


use App\Models\Admin;

class AdminApiController extends Controller
{
    public function insert_api_admin(Request $request){
        $nom = $request->input('nom');
        $email = $request->input('email');
        $pass = $request->input('pass');
        $admin = Admin::create([
            'nom'=>$nom,
            'email'=>$email,
            'mot_de_passe'=>$pass
        ]);
        return response()->json($request);
    }
}
