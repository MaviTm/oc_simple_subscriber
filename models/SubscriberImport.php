<?php

namespace Mavitm\Subscription\Models;

class SubscriberImport extends \Backend\Models\ImportModel
{

    public $table = 'mavitm_subscription_subscriber';

    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {

            try {
                $subscriber = new Subscriber;
                $subscriber->fill($data);
                $subscriber->save();

                $this->logCreated();
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }
}