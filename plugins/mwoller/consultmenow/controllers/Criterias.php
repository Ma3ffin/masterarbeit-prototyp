<?php namespace Mwoller\Consultmenow\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Criterias extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'consultmenow' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Mwoller.Consultmenow', 'consultmenow', 'criteria');
    }
}
