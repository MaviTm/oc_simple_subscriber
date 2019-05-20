<?php namespace Mavitm\Subscription\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMavitmSubscriptionSubtype extends Migration
{
    public function up()
    {
        Schema::create('mavitm_subscription_subtype', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mavitm_subscription_subtype');
    }
}
