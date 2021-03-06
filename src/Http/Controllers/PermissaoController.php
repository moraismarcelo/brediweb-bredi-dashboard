<?php

namespace Brediweb\BrediDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\BrediDashboard\Models\Permissao;
use Brediweb\BrediDashboard\Models\GrupoUsuario;
use Brediweb\BrediDashboard\Models\CategoriaTransacao;
use Brediweb\BrediDashboard\Models\Transacao;

class PermissaoController extends Controller
{
    public function __construct()
    {
        $this->vendor = config('bredidashboard.templates')[config('bredidashboard.default')];
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return redirect()->route('bredidashboard::controle.permissao.edit');
        return view($this->vendor['name'] . '::controle.permissao.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view($this->vendor['name'] . '::controle.permissao.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bredidashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $id = null)
    {
        $permissaos = [];

        $grupoUsuarios          = GrupoUsuario::where('id', '!=', 1)->pluck('nome', 'id');

        $categoriaTransacaos    = [];

        $input = $request->only('grupo_usuario_id');

        if (isset($input['grupo_usuario_id'])) {
            $categoriaTransacaos = CategoriaTransacao::with('transacaos')->get();
            $permissaos = Permissao::where('grupo_usuario_id', $input['grupo_usuario_id'])->pluck('transacao_id')->toArray();
        }

        return view($this->vendor['name'] . '::controle.permissao.form', compact('permissaos', 'grupoUsuarios', 'input', 'categoriaTransacaos'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id = null)
    {
        $request->validate([
            'transacao' => 'required'
        ]);

        try {

            if(!empty($id)) {

                if(count($request->get('transacao')) > 0) {

                    $grupo_usuario = GrupoUsuario::find($id);

                    $grupo_usuario->permissaos()->sync($request->get('transacao'));
                }
            }

            return redirect()->back()->with('msg', 'Opera????o finalizada!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Erro ao realizar a opera????o!')->with('error', true)->with('exception', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
