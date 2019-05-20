<?php namespace Mavitm\Subscription\Models;

use Model;

/**
 * Model
 */
class Subscriber extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'mavitm_subscription_subscriber';

    public $rules = [];

    protected $guarded = [];

    public $belongsTo = [
        "subtype" => "Mavitm\Subscription\Models\Subtype"
    ];
}
