<?php namespace Mwoller\Consultmenow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMwollerConsultmenowConsultant extends Migration
{
    public function up()
    {
        Schema::create('mwoller_consultmenow_consultant', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->integer('company_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mwoller_consultmenow_consultant');
    }
}
