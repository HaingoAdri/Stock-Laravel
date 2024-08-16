<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produits;
use App\Models\Achat;
use App\Models\Vente;
use App\Models\Panier;
use App\Models\Panier_detail;
use App\Models\Historique_achat;
use App\Models\Historique_vente;
use App\Models\Mouvements;
use App\Models\Produits_cout_vente;
use Carbon\Carbon;

class MouvementApiController extends Controller
{
    public function insert_api_achats(Request $request){
        $achats = $request->input('achat');
        foreach ($achats as $produit) {
            $id = (new Achat())->createId();
            Achat::create([
                'id' => $id,
                'date' => $produit['date'],
                'produits' => $produit['produit'],
                'quantite' => $produit['quantite'],
                'prix_unitaire' => $produit['prix']
            ]);
        }
        return response()->json($achats);
    }

    public function voir_api_Stock(){
        $liste_Achats = (new Achat())->get_Achat();
        return response()->json($liste_Achats);
    }

    public function get_api_Price_product(){
        $produits_cout_vente = (new Produits_cout_vente())->get_Data_Produits_Vente_Cout();
        return response()->json($produits_cout_vente);
    }

    
}
