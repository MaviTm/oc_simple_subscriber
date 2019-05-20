<?php namespace Mavitm\Subscription\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Subscribers extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend.Behaviors.ImportExportController',
        ];
    
    public $listConfig          = 'config_list.yaml';
    public $formConfig          = 'config_form.yaml';
    public $importExportConfig  = 'config_import_export.yaml';

    public $requiredPermissions = [
        'subscriber_manage' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Mavitm.Subscription', 'main-menu-subscriber');
    }

    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->accepts) {
            return 'safe disabled';
        }
    }
}
