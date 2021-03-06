<?php

namespace Brediweb\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;
use App\User as Usuario;
use Brediweb\BrediDashboard\Scope\PermissaoScope;

class User extends Usuario
{
    protected $fillable = [
        'grupo_usuario_id',
        'name',
        'email',
        'password',
        'imagem'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PermissaoScope);
    }

    
    public function grupoUsuario()
    {
        return $this->belongsTo(\Brediweb\BrediDashboard\Models\GrupoUsuario::class);
    }
    
}
