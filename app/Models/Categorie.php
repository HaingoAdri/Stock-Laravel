<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Assurez-vous d'importer le bon namespace

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categorie';
    protected $fillable = ['id', 'nom'];

    public function createId()
    {
        $sequenceName = 'categorie_seq';
        $prefix = 'C';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);

        // Retourne l'identifiant généré
        return $response[0]->id;
    }

    public function get_Categorie(){
        $reponse = DB::select('select * from categorie');
        return $reponse;
    }
}
