<?php namespace Mwoller\Consultmenow;

use Mwoller\Consultmenow\Components\CompanyList;
use Mwoller\Consultmenow\Components\CompanyPage;
use Mwoller\Consultmenow\Components\ConsultantPage;
use Mwoller\Consultmenow\Components\RatingPage;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            CompanyList::class => 'companyList',
            CompanyPage::class => 'companyPage',
            ConsultantPage::class => 'consultantPage',
            RatingPage::class => 'ratingPage',
        ];
    }

    public function registerSettings()
    {
    }

    public $require = ['Rainlab.User'];
}
