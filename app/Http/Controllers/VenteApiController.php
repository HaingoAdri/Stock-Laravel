<?php

namespace App\Http\Controllers;

use App\Models\Mouvements;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VenteApiController extends Controller
{
    public function get_ApiMouvements(){
        $liste_mouvements = (new Mouvements())->get_Mouvements();
        return response()->json($liste_mouvements);
    }

    public function liste_Api_historique_achats(){
        $liste_historique_achat = DB::select('select * from view_historique_achats order by date asc');
        return response()->json($liste_historique_achat);
    }

    public function liste_Api_historique_vente(){
        $liste_historique_vente = DB::select('select * from view_historique_vente');
        return response()->json($liste_historique_vente);
    }
}
