<?php namespace Mwoller\Consultmenow\Models;

use Model;
use System\Models\File;

/**
 * Model
 */
class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mwoller_consultmenow_company';

    public $hasMany = [
        'consultants' => [
            Consultant::class,
            'delete' => true
        ]
    ];

    public $attachOne = [
        'picture' => File::class,
    ];

    public function getConsultantRatingAttribute()
    {
        $companyId = $this->id;
        $ratingIds = Rating::whereHas('consultant', function($q) use($companyId){
            $q->where('company_id', '=', $companyId);
        })->pluck('id')->all();

        return round(CriteriaRating::whereIn('rating_id', $ratingIds)->avg('value'));

    }
}
