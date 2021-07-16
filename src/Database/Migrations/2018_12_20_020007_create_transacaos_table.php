<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTransacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_transacao_id')->unsigned();
            $table->foreign('categoria_transacao_id')->references('id')->on('categoria_transacaos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('permissao')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        $categorias = DB::table('categoria_transacaos')->get();

        if (count($categorias) > 5) {
            DB::table('transacaos')->insert([
                'categoria_transacao_id' => 1,
                'permissao' => 'controle.index.index',
                'descricao' => 'Acesso ao Dashboard',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $array = [2 => 'grupo-usuario', 3 => 'usuario', 4 => 'categoria-transacao', 5 => 'transacao', 6 => 'permissao', 'config'];

            foreach ($array as $id => $grupo) {
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.index',
                    'descricao' => 'Visualizar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.create',
                    'descricao' => 'Cadastrar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.edit',
                    'descricao' => 'Editar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.store',
                    'descricao' => 'Salvar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.update',
                    'descricao' => 'Alterar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('transacaos')->insert([
                    'categoria_transacao_id' => $id,
                    'permissao' => 'controle.' . $grupo . '.destroy',
                    'descricao' => 'Deletar',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            }

        }

        $categoria = DB::table('categoria_transacaos')->where('nome', 'Dashboard')->first();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacaos');
    }
}
