<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Models\Admin;
use App\Models\TokenUser;
use Illuminate\Support\Facades\DB;


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

    public function login_api_connect(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $admin = Admin::where('email', $email)
        ->where('mot_de_passe', $password)
        ->first();

    if ($admin) {
        $idUser = $admin->id;

        $existingToken = TokenUser::where('iduser', $idUser)->first();

        if ($existingToken) {
            $existingToken->api_token = Str::random(60);
            $existingToken->save();
            return response()->json(['token' => $existingToken->api_token, 'message' => 'Token mis à jour avec succès']);

        } else {
            $token = Str::random(60);
            TokenUser::create([
                'api_token' => $token,
                'iduser' => $idUser,
            ]);
            return response()->json(['token' => $token, 'message' => 'Connexion réussie']);
        }
    } else {
        return response()->json(['message' => 'Échec de la connexion'], 401);
    }
}


public function logout_api(Request $request)
   {
       $user = auth('api')->user();
   
        if ($user) {
           $deleted = DB::table('tokenuser')->where('iduser', $user->iduser)->delete();
   
            if ($deleted) {
               return response()->json(['message' => 'Utilisateur déconnecté avec succès'], 200);
            } else {
               return response()->json(['message' => 'Aucune entrée trouvée pour l\'utilisateur authentifié'], 404);
            }
        } else {
           return response()->json(['message' => 'Utilisateur non authentifié'], 401);
       }
    }
    
    
}
