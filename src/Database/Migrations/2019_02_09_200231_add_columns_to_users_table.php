<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('grupo_usuario_id')->unsigned()->nullable()->after('id');
            $table->foreign('grupo_usuario_id')->references('id')->on('grupo_usuarios');
            $table->string('imagem')->nullable()->after('email');
        });

        $grupoUsuario = DB::table('grupo_usuarios')->find(1);

        DB::table('users')->insert([
            'name' => 'Bredi Tecnologia Digital',
            'email' => 'contato@bredi.com.br',
            'password' => bcrypt('123456'),
            'grupo_usuario_id' => (isset($grupoUsuario->id) ? $grupoUsuario->id : null),
            'imagem' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_grupo_usuario_id_foreign');
            $table->dropColumn('grupo_usuario_id');
            $table->dropColumn('imagem');
        });
    }
}
