<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique_vente extends Model
{
    use HasFactory;
    protected $table = 'historique_vente';
    protected $fillable = ['id','vente','produits','date','quantite'];
}
