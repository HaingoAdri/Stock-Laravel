<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenUser extends Model
{
    protected $table = 'tokenuser';

    // Ajouter 'iduser' au tableau $fillable
    protected $fillable = ['id', 'api_token', 'iduser'];

    public $timestamps = false;

    // Définir la relation avec le modèle Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'iduser');
    }
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->api_token;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
}
