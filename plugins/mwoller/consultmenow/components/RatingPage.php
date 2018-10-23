<?php
/**
 * Created by PhpStorm.
 * User: mwoller
 * Date: 10.10.2018
 * Time: 09:51
 */

namespace Mwoller\Consultmenow\Components;


use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Mwoller\Consultmenow\Models\Consultant;
use Mwoller\Consultmenow\Models\Criteria;
use Mwoller\Consultmenow\Models\CriteriaRating;
use Mwoller\Consultmenow\Models\Rating;
use October\Rain\Exception\ValidationException;
use RainLab\User\Facades\Auth;

class RatingPage extends ComponentBase
{
    protected $consultant;

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'mwoller.consultmenow::lang.rating_page.name',
            'description' => 'mwoller.consultmenow::lang.rating_page.description'
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
        $consultantid = $this->property('id');
        if(!empty($consultantid)){
            $this->consultant = Consultant::find($consultantid);
        }

    }

    public function onSaveRating()
    {
        $this->onRun();

        $post = post();

        $user = Auth::getUser();

        if($this->validateRating()){

            $rating = new Rating();
            $rating->fill(['consultant' => $this->consultant, 'user' => $user]);
            $rating->save();

            foreach ($post['rating'] as $postRating){
                $criteria = $this->criteria($postRating['criteria']);
                if(!empty($criteria)){
                    $criteriaRating = new CriteriaRating();
                    $criteriaRating->fill(['rating' => $rating, 'criteria' => $criteria, 'value' => $postRating['rating']]);
                    $criteriaRating->save();
                }
            }

        }

    }

    public function consultant()
    {
        return $this->consultant;
    }

    public function consultantPage()
    {
        return $this->property('consultantPage');
    }

    public function criterias()
    {
        return Criteria::orderBy('name', 'asc')->get();
    }

    public function criteria($criteriaId)
    {
        if(!empty($criteriaId)){
            return Criteria::find($criteriaId);
        }

    }

    private function validateRating(){
        $rules = [
            'rating.*.rating' => 'required'
        ];

        $validator = Validator::make(
            post(),
            $rules,
            Lang::get('mwoller.consultmenow::validation'),
            Lang::get('mwoller.consultmenow::validation.custom')
        );

        if($validator->fails()){
            throw new ValidationException($validator->getMessageBag()->getMessages());
        }

        return true;
    }
}