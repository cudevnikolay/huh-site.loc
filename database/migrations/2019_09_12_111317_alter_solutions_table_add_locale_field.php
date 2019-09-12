<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolutionsTableAddLocaleField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->string('locale', 10)->default('en')->after('id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn('locale');
        });
    }
}
