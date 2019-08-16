<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLanguagesTableAddEnableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translator_languages', function (Blueprint $table) {
            $table->boolean('enabled')->default(1)->after('name');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translator_languages', function (Blueprint $table) {
            $table->dropColumn('enabled');
        });
    }
}
