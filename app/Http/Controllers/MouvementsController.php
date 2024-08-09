<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Picqer\Barcode\BarcodeGeneratorPNG;

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
use App\Services\PdfService; 

class MouvementsController extends Controller
{
    public function index(){
        $liste_Produits = (new Produits())->getProduits();
        return view('achat.insertion_stock', compact("liste_Produits"));
    }

    public function insert_achats(Request $request){
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
        return redirect()->back();
    }

    public function voir_Stock(){
        $liste_Achats = (new Achat())->get_Achat();
        return view("achat.voir_stock", compact("liste_Achats"));
    }

    public function inserer_Cout_Vente_Achat(){
        $liste_Produits = (new Produits())->getProduits();
        return view("achat.cout_vente_produits", compact("liste_Produits"));
    }

    public function store(Request $request)
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        foreach ($request->produits as $produit) {
            if (!empty($produit['cout'])) {
                $produitCoutVente = Produits_cout_vente::firstOrNew(['produits' => $produit['id']]);

                // Générer un nouvel ID et un code-barres seulement si l'enregistrement n'existe pas
                if (!$produitCoutVente->exists) {
                    $produitCoutVente->id = (new Produits_cout_vente())->createId();
                    $code_barre = $generator->getBarcode($produit['id'] , $generator::TYPE_CODE_128);
                    $produitCoutVente->code_barre = base64_encode($code_barre);
                }

                $produitCoutVente->date = $produit['date'];
                $produitCoutVente->prix_vente = $produit['cout'];
                $produitCoutVente->updated_at = now();

                $produitCoutVente->save();
            }
        }
        return redirect()->back()->with('success', 'Les coûts de vente ont été ajoutés ou mis à jour avec succès.');
    }

    public function get_Price_product(){
        $produits_cout_vente = (new Produits_cout_vente())->get_Data_Produits_Vente_Cout();
        return view('achat.liste_cout_produits',compact("produits_cout_vente"));
    }

    public function creation_de_panier(){
        $produits_cout_vente = (new Produits_cout_vente())->get_Data_Produits_Vente_Cout();
        $produits = (new Produits())->getProduits();
        return view('achat.panier_creation',compact("produits_cout_vente", "produits"));
    }

    public function getPanier(Request $request){
        foreach($request->produit as $produits){
            $produitCoutVente = Produits_cout_vente::firstOrNew(['produits' => $produits['id']]);
        }
    }

    public function createPanier(Request $request) {
        $idPrixVente = $request->input('productId');
        $quantites = $request->input('quantite');
        $montantDonner = $request->input('montant_payer');
        $motantPayer = $request->input('montantTotal');
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

        return app(PdfService::class)->generatePdf($data);
    }
}
