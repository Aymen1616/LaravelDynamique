<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Titre de l'article
            $table->text('content');  // Contenu de l'article
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur (étudiant)
            $table->enum('language', ['fr', 'en']);  // Langue de l'article
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
