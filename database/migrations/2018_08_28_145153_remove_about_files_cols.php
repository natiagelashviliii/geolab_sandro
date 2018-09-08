<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAboutFilesCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about', function($table) {
            $table->dropColumn('has_photo');
            $table->dropColumn('photo_ver');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about', function($table) {
            $table->integer('has_photo');
            $table->integer('photo_ver');
        });
    }
}
