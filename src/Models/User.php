<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;
use App\User as Usuario;
use Bredi\BrediDashboard\Scope\PermissaoScope;

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
        return $this->belongsTo(\Bredi\BrediDashboard\Models\GrupoUsuario::class);
    }
    
}
