<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achat extends Model
{
    use HasFactory;
    protected $table = 'achat';
    protected $fillable = ['id','date','produits','quantite','prix_unitaire','montant_total'];

    public function createId()
    {
        $sequenceName = 'achat_seq';
        $prefix = 'A';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);
        return $response[0]->id;
    }

    public function get_Achat(){
        return DB::select('select * from view_achat');
    }

    public function getAchatByProduct($produits){
        return DB::table('view_achat')
                 ->where('produits', $produits)
                 ->first();
    }
}
