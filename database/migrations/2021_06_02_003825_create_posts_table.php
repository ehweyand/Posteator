<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // auto incrementing primary key
            //$table->integer('user_id')->unsigned()->index(); // index para indexar e aumenta desempenho no banco
            $table->foreignId('user_id')->constrained()->onDelete('cascade');// referencia automaticamente a tabela users usando o id, o laravel reconhece sozinho
            // cascade: se deletar um usuário, também deleta os posts relacionados a ele
            $table->text('body');
            $table->timestamps(); // created_at - updated_at (opcional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
