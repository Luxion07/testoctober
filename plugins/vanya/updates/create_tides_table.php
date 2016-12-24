<?php namespace Vanya\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTidesTable extends Migration
{
    public function up()
    {
        Schema::create('tides_info', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('theme_data_id')->default(1)->nullable();
            $table->string('max')->nullable();
            $table->string('max_time')->nullable();
            $table->string('min')->nullable();
            $table->string('min_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tides_info');
    }
}
