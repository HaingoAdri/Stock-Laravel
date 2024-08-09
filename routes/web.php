<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\MouvementsController;
use App\Http\Controllers\OutilController;
use App\Http\Controllers\VentesController;
use App\Http\Controllers\InvoiceController;

// login et inscription
Route::get('/', [AdminController::class, 'go_login'])->name('login');
Route::get('/register', [AdminController::class, 'go_register'])->name('register');
Route::post('/go_connexion', [AdminController::class, 'login_connect'])->name('go_connexion');
Route::post('/go_register', [AdminController::class, 'insert_admin'])->name('go_register');

// page 
Route::get('/acceuil', [MouvementsController::class, 'index'])->name('acceuil');

// outil 
Route::get('/categorie', [OutilController::class, 'go_to_Catgorie_information'])->name('categorie');
Route::get('/couleur', [OutilController::class, 'go_to_Couleur_information'])->name('couleur');
Route::get('/taille', [OutilController::class, 'go_to_Taille_information'])->name('taille');
Route::get('/produits', [OutilController::class, 'go_produit'])->name('produits');
Route::post('/insert_taille', [OutilController::class, 'insert_taille'])->name('insert_taille');
Route::post('/insert_couleur', [OutilController::class, 'insert_couleur'])->name('insert_couleur');
Route::post('/insert_categorie', [OutilController::class, 'insert_categorie'])->name('insert_categorie');
Route::post('/insert_produits', [OutilController::class, 'insert_produits'])->name('insert_produits');
Route::get('/produits/edit/{id}', [OutilController::class, 'edit_produit'])->name('edit_produit');
Route::post('/produits/update/{id}', [OutilController::class, 'update_produit'])->name('update_produit');
Route::delete('/produits/delete/{id}', [OutilController::class, 'delete_produit'])->name('delete_produit');

// achat 
Route::get('/achats', [MouvementsController::class, 'index'])->name('achats');
Route::post('/insert_achats', [MouvementsController::class, 'insert_achats'])->name('insert_achats');
Route::get('/voir_stock', [MouvementsController::class, 'voir_Stock'])->name('voir_stock');
Route::get('/voir_cout_achat', [MouvementsController::class, 'inserer_Cout_Vente_Achat'])->name('voir_cout_achat');
Route::post('/produit-cout-vente', [MouvementsController::class, 'store'])->name('produitCoutVente.store');
Route::get('/voir_cout_vente', [MouvementsController::class, 'get_Price_product'])->name('voir_cout_vente');

// creation de panier 
Route::get('/caisse', [MouvementsController::class, 'creation_de_panier'])->name('caisse');
Route::post('/creation-panier', [MouvementsController::class, 'createPanier'])->name('creation-panier');


// pdf
Route::get('/generate-pdf', [InvoiceController::class, 'generatePDF'])->name('generatePDF');

Route::get('/mouvements', [VentesController::class, 'get_Mouvements'])->name('mouvements');
Route::get('/historique_achats', [VentesController::class, 'liste_historique_achats'])->name('historique_achats');
Route::get('/historique_vente', [VentesController::class, 'liste_historique_vente'])->name('historique_vente');


Route::post('/logout', [AdminController::class, 'logout'])->name('logout');