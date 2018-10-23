<?php namespace Mwoller\Consultmenow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMwollerConsultmenowRating extends Migration
{
    public function up()
    {
        Schema::create('mwoller_consultmenow_rating', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('consultant_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mwoller_consultmenow_rating');
    }
}
