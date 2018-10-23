<?php namespace Mwoller\Consultmenow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMwollerConsultmenowCompany extends Migration
{
    public function up()
    {
        Schema::create('mwoller_consultmenow_company', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mwoller_consultmenow_company');
    }
}
