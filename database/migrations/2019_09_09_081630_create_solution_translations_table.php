<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale', 10);
            $table->unsignedBigInteger('solution_id');
            $table->string('title')->nullable()->default(null);
            $table->string('text')->nullable()->default(null);
    
            $table->unique(['locale', 'solution_id']);
    
            $table->foreign('locale')->references('locale')->on('translator_languages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('solution_id')->references('id')->on('solutions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solution_translations');
    }
}
