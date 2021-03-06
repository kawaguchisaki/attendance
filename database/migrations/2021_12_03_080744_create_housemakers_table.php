<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousemakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housemakers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); //ハウスメーカー名
            $table->boolean('get_help'); //通常０=false、応援１=true
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
        Schema::dropIfExists('housemakers');
    }
}
