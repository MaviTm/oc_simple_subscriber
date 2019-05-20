<?php namespace Mavitm\Subscription\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Subtypes extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'subscriber_manage' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Mavitm.Subscription', 'main-menu-subscriber', 'side-menu-subtype');
    }
}
