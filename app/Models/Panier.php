<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Panier extends Model
{
    use HasFactory;
    protected $table = 'panier';
    protected $fillable = ['id'];

    public function createId()
    {
        $sequenceName = 'panier_seq';
        $prefix = 'PA';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);

        // Retourne l'identifiant généré
        return $response[0]->id;
    }

    public function getPanierById($id){
        return DB::table('panier')
                 ->where('id', $id)
                 ->first();
    }
}