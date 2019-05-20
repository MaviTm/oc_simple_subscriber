<?php

namespace Mavitm\Subscription\Models;

class SubscriberExport extends \Backend\Models\ExportModel
{
    public $table = 'mavitm_subscription_subscriber';

    public function exportData($columns, $sessionKey = null)
    {
        $subscribers = Subscriber::all();
        $subscribers->each(function($subscriber) use ($columns) {
            $subscriber->addVisible($columns);
        });
        return $subscribers->toArray();
    }
}