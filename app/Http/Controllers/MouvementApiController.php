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

    public function creation_de_panier_api() {
        $produits_cout_vente = (new Produits_cout_vente())->get_Data_Produits_Vente_Cout();
        $produits = (new Produits())->getProduits();
    
        return response()->json([
            'produits_cout_vente' => $produits_cout_vente,
            'produits' => $produits
        ]);
    }
    

    
    public function createPanier_api(Request $request) {
        $idPrixVente = $request->input('productId');
        $quantites = $request->input('quantite');
        $montantDonner = $request->input('montant_payer');
        // $motantPayer = $request->input('montantTotal');
        $idPanier = (new Panier())->createId();

        Panier::create([
            'id' => $idPanier
        ]);

        $items = [];
        $totalAmount = 0;

        foreach ($idPrixVente as $key => $id) {
            $quantite = $quantites[$key];
            
            $idVente = (new Vente())->createId();
            Vente::create([
                'id' => $idVente,
                'produits_cout_vente' => $id,
                'quantite' => $quantite,
                'date' => Carbon::now()
            ]);

            $idProduits = Produits_cout_vente::where('id', $id)->first();
            // echo 'produits id = '.$id;
            // var_dump($idProduits->produits);
            Historique_vente::create([
                'vente' => $idVente,
                'produits' =>$idProduits->produits,
                'date' => Carbon::now(),
                'quantite' => $quantite
            ]);

            $achat = (new Achat())->getAchatByProduct($idProduits->produits);
            // var_dump($achat->id);
            Historique_achat::create([
                'achat' => $achat->id,
                'produits' => $achat->produits,
                'date' => $achat->date,
                'quantite' => $achat->quantite
            ]);

            $idMouvements = (new Mouvements())->createId();

            Mouvements::create([
                'id' => $idMouvements,
                'date' => Carbon::now(),
                'achat' => $achat->id,
                'vente' => $idVente
            ]);

            $reste = $achat->quantite - $quantite;

            $achatFind = Achat::where('id',$achat->id)->first();
            // var_dump($achat->id);
            $achatFind->update([
                'produits' => $achat->produits,
                'date' => Carbon::now(),
                'quantite' => $reste
            ]);

            $panier =(new Panier())->getPanierById($idPanier);

            Panier_detail::create([
                'id' => $panier->id,
                'vente' => $idVente
            ]);


            $produit_vente = (new Produits_cout_vente())->getProduitsByProduct($idProduits->produits);

            $itemTotal = $quantite * $produit_vente->prix_vente;
            $totalAmount += $itemTotal;

            $items[] = [
                'name' => $produit_vente->nom,
                'quantity' => $quantite,
                'unit_price' => number_format($produit_vente->prix_vente, 2, ',', ' ') . ' AR',
                'total' => number_format($itemTotal, 2, ',', ' ') . ' Ar',
            ];
        }

        $data = [
            'invoice_number' => $idPanier,
            'date' => now()->format('d F Y'),
            'items' => $items,
            'total_to_pay' => number_format($totalAmount, 2, ',', ' ') . ' AR',
            'amount_given' => number_format($montantDonner, 2, ',', ' ') . ' AR',
            'amount_due' => number_format($montantDonner - $totalAmount, 2, ',', ' ') . ' AR',
        ];
        return $data;
    }
    
}
