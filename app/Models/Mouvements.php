<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mouvements extends Model
{
    use HasFactory;
    protected $table = 'mouvements';
    protected $fillable = ['id', 'date','achat','vente'];

    public function createId()
    {
        $sequenceName = 'mouvements_seq';
        $prefix = 'M';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);

        // Retourne l'identifiant généré
        return $response[0]->id;
    }

    public function get_Mouvements(){
        return DB::select('select * from vue_mouvements_details ');
    }
}
