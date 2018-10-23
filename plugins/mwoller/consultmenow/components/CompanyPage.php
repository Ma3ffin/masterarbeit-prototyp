<?php
/**
 * Created by PhpStorm.
 * User: mwoller
 * Date: 08.10.2018
 * Time: 17:06
 */

namespace Mwoller\Consultmenow\Components;


use Cms\Classes\ComponentBase;
use Mwoller\Consultmenow\Models\Company;
use Mwoller\Consultmenow\Models\Consultant;

class CompanyPage extends ComponentBase
{

    protected $company;

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'mwoller.consultmenow::lang.company_page.name',
            'description' => 'mwoller.consultmenow::lang.company_page.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                'title'       => 'mwoller.consultmenow::lang.listid.name',
                'description' => 'mwoller.consultmenow::lang.listid.description',
                'default'     => '{{ :id }}',
                'type'        => 'string'
            ],
            'consultantPage' => [
                'title'       => 'mwoller.consultmenow::lang.consultant_page.name',
                'description' => 'mwoller.consultmenow::lang.consultant_page.description',
                'type'        => 'string',
                'default'     => 'consultant',
            ],
        ];
    }

    public function onRun()
    {
        $companyid = $this->property('id');
        if(!empty($companyid)){
            $this->company = Company::where('id','=',$companyid)->with(['consultants' => function($q){
                $q->orderBy('lastname', 'asc');
            }])->first();
        }

    }

    public function company()
    {
        return $this->company;
    }

    public function consultantPage()
    {
        return $this->property('consultantPage');
    }
}