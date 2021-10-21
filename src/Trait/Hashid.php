<?php
namespace Brediweb\BrediDashboard\Trait;
use Vinkla\Hashids\Facades\Hashids;
/**
 * trait for create hash id in tables
 */ 
trait Hashid
{

    protected static function boot() {
        parent::boot();
        static::bootCodigo();
    }

    /**
     * Registra o evento created do eloquent para gerar o campo código a partir do id.
     */
    protected static function bootCodigo() {
        static::created(function ($model) {
            $mdHash = substr(uniqid(rand(), true), 0, 3);
            $model->attributes['hash'] = Hashids::encode($model->attributes['id'], $mdHash);
            $model->save();
        });
    }
}
