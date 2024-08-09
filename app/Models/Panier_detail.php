<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Panier_detail extends Model
{
    use HasFactory;
    protected $table = 'panier_detail';
    protected $fillable = ['id','vente'];
}
