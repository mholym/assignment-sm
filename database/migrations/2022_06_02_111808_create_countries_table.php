<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->integer('country_id')->autoIncrement()->primary(); // integer length is 11 by default
            $table->string('code', 2)->comment('Two-letter country code (ISO 3166-1 alpha-2)')->unique();
            $table->string('name', 64)->comment('English country name');
            $table->string('full_name', 128)->comment('Full English country name');
            $table->string('iso3', 3)->comment('Three-letter country code (ISO 3166-1 alpha-3)');
            $table->string('continent_code', 2);
            $table->integer('display_order')->default(900);

        });
        DB::statement('ALTER TABLE MyTable ADD `number` smallint(3) unsigned zerofill NOT NULL');

        Schema::table('countries', function(Blueprint $table){
            $table->foreign('continent_code')->references('code')->on('continents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropForeign('countries_continent_code_foreign');
        });
        Schema::dropIfExists('countries');
    }
};
