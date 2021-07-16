<?php

namespace Bredi\BrediDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Bredi\BrediDashboard\Models\GrupoUsuario;

class GrupoUsuarioController extends Controller
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
        $grupoUsuarios = GrupoUsuario::all();

        return view($this->vendor['name'] . '::controle.grupo-usuario.index', compact('grupoUsuarios'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view($this->vendor['name'] . '::controle.grupo-usuario.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2'
        ]);

        try {

            $input = $request->all();

            GrupoUsuario::create($input);

            return redirect()->route('bredidashboard::controle.grupo-usuario.index')->with('msg', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível realizar o cadastro')->with('error', true)->with('exception', $e->getMessage());
        }
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
    public function edit($id)
    {
        $grupoUsuario = GrupoUsuario::find($id);

        return view($this->vendor['name'] . '::controle.grupo-usuario.form', compact('grupoUsuario'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|min:2'
        ]);

        try {

            $grupoUsuario = GrupoUsuario::whereId($id)->update(['nome' => $request->get('nome')]);

            return redirect()->route('bredidashboard::controle.grupo-usuario.index')->with('msg', 'Registro atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível alterar o registro')->with('error', true)->with('exception', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $grupoUsuario = GrupoUsuario::find($id);

            $grupoUsuario->delete();

            return redirect()->back()->with('msg', 'Registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível excluir o registro.');
        }
    }
}
