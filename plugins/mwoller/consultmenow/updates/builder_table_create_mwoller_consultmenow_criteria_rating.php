<?php namespace Mwoller\Consultmenow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMwollerConsultmenowCriteriaRating extends Migration
{
    public function up()
    {
        Schema::create('mwoller_consultmenow_criteria_rating', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('criteria_id')->unsigned();
            $table->integer('rating_id')->unsigned();
            $table->integer('value');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mwoller_consultmenow_criteria_rating');
    }
}
