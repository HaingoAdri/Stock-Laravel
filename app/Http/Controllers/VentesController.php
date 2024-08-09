<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mouvements;
use Illuminate\Support\Facades\DB;

class VentesController extends Controller
{
    public function get_Mouvements(){
        $liste_mouvements = (new Mouvements())->get_Mouvements();
        return view('historique.mouvements',compact('liste_mouvements'));
    }

    public function liste_historique_achats(){
        $liste_historique_achat = DB::select('select * from view_historique_achats order by date asc');
        return view('historique.historique_achat', compact('liste_historique_achat'));
    }

    public function liste_historique_vente(){
        $liste_historique_vente = DB::select('select * from view_historique_vente');
        return view('historique.historique_vente', compact('liste_historique_vente'));
    }
}
