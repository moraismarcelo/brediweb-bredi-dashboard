<?php

namespace Bredi\BrediDashboard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Route;
use Bredi\BrediDashboard\Models\Permissao;
use Bredi\BrediDashboard\Models\Transacao;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class ValidaPermissao
{
    public function __construct()
    {
        $this->vendor = config('bredidashboard.templates')[config('bredidashboard.default')];
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->loadPermissoes();

        if (isset(Route::current()->action['permissao'])) {

            $this->verificaPermissao(Route::current()->action['permissao']);
        }

        return $next($request);
    }

    public function loadPermissoes()
    {
        if (Schema::hasTable('transacaos')) {
            $user = Auth::user();

            if (isset($user->grupo_usuario_id) and $user->grupo_usuario_id != 1) {
            // if (!in_array($user->email, config('bredidashboard.superadmin'))) {
                $permissaos = Permissao::select('transacaos.*', 'permissaos.grupo_usuario_id')
                                ->join('transacaos', 'permissaos.transacao_id', '=', 'transacaos.id')
                                ->where('permissaos.grupo_usuario_id', $user->grupo_usuario_id)
                                ->get();

                if(count($permissaos) > 0) {
                    foreach($permissaos as $permissao) {
                        Gate::define($permissao->permissao, function () {
                            return true;
                        });
                    }
                }
            } else {
                if (isset($user->grupo_usuario_id) and $user->grupo_usuario_id == 1) {
                    $permissaos = Transacao::get();

                    if(count($permissaos) > 0) {
                        foreach($permissaos as $permissao) {
                            Gate::define($permissao->permissao, function () {
                                return true;
                            });
                        }
                    }
                }

            }
        }
    }

    public function verificaPermissao($transacao)
    {
        if (Gate::denies($transacao)) {
            abort(403);
        }
    }
}
