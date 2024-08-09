<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Categorie;
use App\Models\Taille;
use App\Models\Couleur;
use App\Models\Produits;

class OutilController extends Controller
{
    public function go_to_Catgorie_information(){
        $liste_Categorie = (new Categorie())->get_Categorie();
        return view('outil.categorie', compact('liste_Categorie'));
    }

    public function insert_categorie(Request $request){
        $nom = $request->input('nom');
        $id = (new Categorie())->createId();
        Categorie::create([
            'id'=>$id,
            'nom'=>$nom
        ]);
        return redirect()->back();
    }

    public function go_to_Taille_information(){
        $liste_Taille = Taille::all();
        return view('outil.taille', compact("liste_Taille"));
    }

    public function insert_taille(Request $request){
        $nom = $request->input('nom');
        Taille::create([
            'nom'=>$nom
        ]);
        return redirect()->back();
    }

    public function go_to_Couleur_information(){
        $liste_Couleur = Couleur::all();
        return view('outil.couleur', compact('liste_Couleur'));
    }

    public function insert_couleur(Request $request){
        $nom = $request->input('nom');
        Couleur::create([
            'nom'=>$nom
        ]);
        return redirect()->back();
    }

    // produits 
    public function go_produit(){
        $liste_Produits = (new Produits())->getProduits();
        $liste_Categorie = (new Categorie())->get_Categorie();
        $liste_Couleur = Couleur::all();
        $liste_Taille = Taille::all();
        return view('outil.produits', compact('liste_Produits','liste_Categorie','liste_Couleur','liste_Taille'));
    }

    public function insert_produits(Request $request){
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
        return redirect()->back();
    }

    public function edit_produit($id) {
        $produit = DB::table('produits')->where('id',$id)->first();
        $liste_Couleur = Couleur::all();
        $liste_Taille = Taille::all();
        $liste_Categorie = (new Categorie())->get_Categorie();
        return view('outil.edit_produit', compact('produit', 'liste_Couleur', 'liste_Taille', 'liste_Categorie'));
    }

    public function update_produit(Request $request, $id) {
        $produit = DB::table('produits')->where('id',$id)->first();
        // var_dump($id);
        $updated = DB::table('produits')->where('id', $id)->update([
            'nom' => $request->input('nom'),
            'couleur' => $request->input('couleur'),
            'taille' => $request->input('taille'),
            'categorie' => $request->input('categorie')
        ]);
    
        if ($updated) {
            return redirect()->route('produits')->with('success', 'Produit mis à jour avec succès.');
        } else {
            return redirect()->route('produits')->with('error', 'Aucune modification apportée.');
        }
    }

    public function delete_produit($id) {
        DB::table('produits')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès.');
    }
    
}
