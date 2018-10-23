<?php namespace Mwoller\Consultmenow\Models;

use Model;
use System\Models\File;

/**
 * Model
 */
class Consultant extends Model
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
        'firstname' => 'required',
        'lastname' => 'required',
        'company' => 'required',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mwoller_consultmenow_consultant';

    public $belongsTo = [
        'company' => Company::class,
    ];

    public $hasMany = [
        'ratings' => [
            Rating::class,
            'delete' => true
        ]
    ];

    public $attachOne = [
        'picture' => File::class,
    ];

    public function getNameAttribute()
    {
        return sprintf("%s - %s", $this->firstname, $this->lastname);
    }

    public function getGeneralRatingAttribute()
    {

        $ratingIds = $this->ratings()->pluck('id')->all();

        return round(CriteriaRating::whereIn('rating_id', $ratingIds)->avg('value'));

    }

    public function getCriteriaRatingSum(Criteria $criteria)
    {
            $ratingIds = $this->ratings()->pluck('id')->all();

            return round(CriteriaRating::whereIn('rating_id', $ratingIds)->where('criteria_id','=', $criteria->id)->avg('value'));
    }

}
