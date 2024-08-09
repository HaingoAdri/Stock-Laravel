<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique_achat extends Model
{
    use HasFactory;
    protected $table = 'historique_achat';
    protected $fillable = ['id','achat','produits','date','quantite'];
}
