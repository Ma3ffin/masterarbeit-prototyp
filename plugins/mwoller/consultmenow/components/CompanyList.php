<?php
/**
 * Created by PhpStorm.
 * User: mwoller
 * Date: 08.10.2018
 * Time: 16:40
 */
namespace Mwoller\Consultmenow\Components;

use Cms\Classes\ComponentBase;
use Mwoller\Consultmenow\Models\Company;

class CompanyList extends ComponentBase
{

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'mwoller.consultmenow::lang.company_list.name',
            'description' => 'mwoller.consultmenow::lang.company_list.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'companyPage' => [
                'title'       => 'mwoller.consultmenow::lang.company_page.name',
                'description' => 'mwoller.consultmenow::lang.company_page.description',
                'type'        => 'string',
                'default'     => 'company',
            ],
        ];
    }

    public function all()
    {
        return Company::orderBy('name','asc')->get();
    }

    public function companyPage()
    {
        return $this->property('companyPage');
    }
}