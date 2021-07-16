<?php

namespace Bredi\BrediDashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $casts = [
        'config' => 'array',
    ];

    protected $appends = ['background', 'logo'];

    protected $fillable = ['nome', 'config'];

    public function getBackgroundAttribute()
    {
        if(isset($this->config['layout']['background_image']) and !empty($this->config['layout']['background_image'])){
            return route('imagem.render', config('bredidashboard.background_image.destino') . $this->config['layout']['background_image']);
        } else {
            return '/coloradmin/images/login-bg-17.jpg';
        }
    }
    public function getLogoAttribute()
    {
        if(isset($this->config['layout']['logo']) and !empty($this->config['layout']['logo'])){
            return route('imagem.render', 'company/p/' . $this->config['layout']['logo']);
        } else {
            return null;
        }
    }
}
