<?php
/**
 * Created by PhpStorm.
 * User: mwoller
 * Date: 09.10.2018
 * Time: 09:35
 */

namespace Mwoller\Consultmenow\Components;


use Cms\Classes\ComponentBase;
use Mwoller\Consultmenow\Models\Consultant;
use Mwoller\Consultmenow\Models\Criteria;

class ConsultantPage extends ComponentBase
{
    protected $consultant;

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'mwoller.consultmenow::lang.consultant_page.name',
            'description' => 'mwoller.consultmenow::lang.consultant_page.description'
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
            'ratingPage' => [
                'title'       => 'mwoller.consultmenow::lang.rating_page.name',
                'description' => 'mwoller.consultmenow::lang.rating_page.description',
                'type'        => 'string',
                'default'     => 'rating',
            ],
        ];
    }

    public function onRun()
    {
        $consultantid = $this->property('id');
        if(!empty($consultantid)){
            $this->consultant = Consultant::find($consultantid);
        }

    }

    public function consultant()
    {
        return $this->consultant;
    }

    public function ratingPage()
    {
        return $this->property('ratingPage');
    }

    public function criterias()
    {
        return Criteria::orderBy('name', 'asc')->get();
    }

}