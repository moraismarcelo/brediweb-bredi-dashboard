<?php

namespace Brediweb\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transacao extends Model
{
    protected $fillable = ['categoria_transacao_id', 'permissao', 'descricao'];

    public function permissaos()
    {
        return $this->hasMany(\Brediweb\BrediDashboard\Models\Permissao::class)->where('grupo_usuario_id', Auth::user()->grupo_usuario_id)->get();
    }

}
