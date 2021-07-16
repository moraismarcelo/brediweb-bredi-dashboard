<?php

namespace Bredi\BrediDashboard\Http\Controllers\Auth;

use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Bredi\BrediDashboard\Models\UserGrupoUsuario;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BrediDashboardLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/controle';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route('bredidashboard::dashboard');
    }

     /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Recupera todas as permissões do usuário e armazena na sessão
        session(['permissao' => $this->permissao($user)]);
    }

    protected function permissao()
    {
        // $userGrupoUsuarios = UserGrupoUsuario::with('permissaos')->where('user_id', Auth::id())->first();
        // return $userGrupoUsuarios->permissaos->KeyBy('transacao_id')->toArray();
        return ['index', 'noticia', 'post'];
    }

    protected function loggedOut(Request $request)
    {
        return redirect($this->redirectTo);
    }
}
