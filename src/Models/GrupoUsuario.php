<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Bredi\BrediDashboard\Scope\PermissaoScope;

class GrupoUsuario extends Model
{
    protected $fillable = ['nome'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PermissaoScope);
    }

    public function permissaos()
    {
        return $this->belongsToMany(\Bredi\BrediDashboard\Models\Transacao::class, 'permissaos');//, 'transacao_id', 'id'
    }
}
