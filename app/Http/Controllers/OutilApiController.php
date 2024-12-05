<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Categorie;
use App\Models\Taille;
use App\Models\Couleur;
use App\Models\Produits;

class OutilApiController extends Controller
{
    public function list_to_Api_Categorie_information(){
        $liste_Categorie = (new Categorie())->get_Categorie();
        return response()->json($liste_Categorie);
    }

    public function list_api_Taille_information(){
        $liste_Taille = Taille::all();
        return response()->json($liste_Taille);
    }

    public function list_api_Couleur_information(){
        $liste_Couleur = Couleur::all();
        return response()->json($liste_Couleur);
    }

    public function list_api_produit(){
        $liste_Produits = (new Produits())->getProduits();
        return response()->json($liste_Produits);
    }

    public function edit_api_produit($id) {
        $produit = DB::table('produits')->where('id',$id)->first();
        $liste_Couleur = Couleur::all();
        $liste_Taille = Taille::all();
        $liste_Categorie = (new Categorie())->get_Categorie();
        return response()->json($produit);
    }

    public function insert_api_produits(Request $request){
            $id = (new Produits())->createId();
            Produits::create([
                'id' => $id,
                'nom' => $request['nom'],
                'couleur' => $request['couleur'],
                'taille' => $request['taille'],
                'categorie' => $request['categorie']
            ]);
        return response()->json($request);
    }

    public function insert_api_list_produits(Request $request){
        $produits = $request->input('produits');
        foreach ($produits as $produit) {
            $id = (new Produits())->createId();
            Produits::create([
                'id' => $id,
                'nom' => $produit['nom'],
                'couleur' => $produit['couleur'],
                'taille' => $produit['taille'],
                'categorie' => $produit['categorie']
            ]);
        }
        return response()->json($produits);
    }

    public function insert_api_categorie(Request $request){
        $nom = $request->input('nom');
        $id = (new Categorie())->createId();
        Categorie::create([
            'id'=>$id,
            'nom'=>$nom
        ]);
        return response()->json($request);
    }

    public function insert_api_taille(Request $request){
        $nom = $request->input('nom');
        Taille::create([
            'nom'=>$nom
        ]);
        return response()->json($request);
    }

    public function insert_api_couleur(Request $request){
        $nom = $request->input('nom');
        Couleur::create([
            'nom'=>$nom
        ]);
        return response()->json($request);
    }


    public function update_api_produit(Request $request, $id) {
        $produit = DB::table('produits')->where('id',$id)->first();
        // var_dump($id);
        $updated = DB::table('produits')->where('id', $id)->update([
            'nom' => $request->input('nom'),
            'couleur' => $request->input('couleur'),
            'taille' => $request->input('taille'),
            'categorie' => $request->input('categorie')
        ]);
        if($updated){
            return response()->json("updated successfully",200);
        }
        else{
            return response()->json("updated failed");
        }
        // return response()->json($updated);
      
    }

    public function delete_api_produit($id) {
        DB::table('produits')->where('id', $id)->delete();
        return response()->json("deleted successfully",200);
    }
}
