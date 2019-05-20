<?php namespace Mavitm\Subscription;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            "Mavitm\Subscription\Components\Subscriber" => "MtmSubscriber"
        ];
    }

    public function registerSettings()
    {
    }
}
