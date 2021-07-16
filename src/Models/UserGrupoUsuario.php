<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;

class UserGrupoUsuario extends Model
{
    protected $fillable = ['user_id', 'grupo_usuario_id'];

    public function permissaos()
    {
        return $this->hasMany(Permissao::class, 'grupo_usuario_id');
    }
}
