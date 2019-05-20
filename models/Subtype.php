<?php namespace Mavitm\Subscription\Models;

use Model;

/**
 * Model
 */
class Subtype extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    public $table = 'mavitm_subscription_subtype';

    public $rules = [];

    public $hasMany = [
        "subscribers" => "Mavitm\Subscription\Models\Subscriber"
    ];
}
