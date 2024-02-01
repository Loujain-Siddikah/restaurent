<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgsNameToSectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_items', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_items', function (Blueprint $table) {
            $table->dropColumn('name')->nullable();
            $table->dropColumn('img2')->nullable();
            $table->dropColumn('img3')->nullable();
        });
    }
}
