<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produits_cout_vente extends Model
{
    use HasFactory;
    protected $table = 'produits_cout_vente';
    protected $fillable = ['id', 'date','prix_vente','produits',  'code_barre', 'updated_at'];

    public function get_Data_Produits_Vente_Cout(){
        return DB::select('select id,nom,prix_vente,code_barre,date from view_produits_cout_vente');
    }

    public function createId()
    {
        $sequenceName = 'produits_couts_seq';
        $prefix = 'PC';
        $numZeros = 4;

        $response = DB::select('SELECT generate_custom_id(?, ?, ?) AS id', [
            $sequenceName,
            $prefix,
            $numZeros
        ]);
        return $response[0]->id;
    }

    public function getProduitsByProduct($produits){
        return DB::table('view_produits_cout_vente')
                 ->where('produits', $produits)
                 ->first();
    }
}
