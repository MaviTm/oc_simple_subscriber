<?php namespace Mavitm\Subscription\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMavitmSubscriptionSubscriber extends Migration
{
    public function up()
    {
        Schema::create('mavitm_subscription_subscriber', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->smallInteger('accepts')->nullable()->unsigned();
            $table->integer('subtype_id')->nullable()->unsigned();
            $table->string('content_id')->nullable()->index();
            $table->string('content_type')->nullable()->index();
            $table->string('data')->nullable()->index();
            $table->string('ip')->nullable()->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mavitm_subscription_subscriber');
    }
}
