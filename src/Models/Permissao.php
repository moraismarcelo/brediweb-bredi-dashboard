<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $fillable = ['grupo_usuario_id', 'transacao_id'];

    public $timestamps = false;

}
