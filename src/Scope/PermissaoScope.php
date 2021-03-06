<?php

namespace Brediweb\BrediDashboard\Scope;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Brediweb\BrediDashboard\Models\User;
use Brediweb\BrediDashboard\Models\GrupoUsuario;

class PermissaoScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $auth = Auth::user();
        
        if ($auth->grupo_usuario_id != 1) {
            if ($model->getTable() == 'grupo_usuarios') {
                $builder->where('id', '!=', 1);
            }
            if ($model->getTable() == 'users') {
                $builder->where('grupo_usuario_id', '!=', 1);
            }
        }
        
    }
}