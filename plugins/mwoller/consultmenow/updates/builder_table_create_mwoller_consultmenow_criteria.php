<?php namespace Mwoller\Consultmenow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMwollerConsultmenowCriteria extends Migration
{
    public function up()
    {
        Schema::create('mwoller_consultmenow_criteria', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mwoller_consultmenow_criteria');
    }
}
