<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vente extends Model
{
    use HasFactory;
    protected $table = 'vente';
    protected $fillable = ['id', 'produits_cout_vente','quantite','date'];

    public function createId()
    {
        $sequenceName = 'vente_seq';
        $prefix = 'VE';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);

        // Retourne l'identifiant généré
        return $response[0]->id;
    }
}
