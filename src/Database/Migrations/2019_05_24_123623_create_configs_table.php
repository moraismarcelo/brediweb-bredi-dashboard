<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nome', 100)->nullable()->default('Bredi');
            
            $table->longText('config')->nullable();
            
            $table->timestamps();
        });

        DB::table('configs')->insert([
            'nome' => 'Bredi',
            'config' => '{"projeto":{"nome":"Bredi"},"layout":{"background_image":"fundo.jpeg"}}',
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
        Schema::dropIfExists('configs');
    }
}
