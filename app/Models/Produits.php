<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produits extends Model
{
    use HasFactory;
    protected $table = 'produits';
    protected $fillable = ['id', 'nom','couleur','taille','categorie'];

    public function createId()
    {
        $sequenceName = 'produits_seq';
        $prefix = 'P';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);

        // Retourne l'identifiant généré
        return $response[0]->id;
    }

    public function getProduits(){
        $response = DB::select('select * from view_produits');
        return $response;
    }
}
