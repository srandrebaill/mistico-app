<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }

    public function plano()
    {
        return $this->hasOne(Plano::class, 'id', 'plano_id');
    }
}
