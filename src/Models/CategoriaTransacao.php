<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaTransacao extends Model
{
    protected $fillable = ['nome'];

    public function transacaos()
    {
        return $this->hasMany(Transacao::class);
    }

}
