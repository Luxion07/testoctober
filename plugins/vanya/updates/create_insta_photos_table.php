<?php namespace Vanya\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateInstaPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('insta_photos', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('theme_data_id')->default(1)->nullable();
            $table->string('src')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insta_photos');
    }
}
