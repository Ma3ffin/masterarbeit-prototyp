<?php namespace Mwoller\Consultmenow\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class Rating extends Model
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
        'consultant' => 'required',
        'user' => 'required',
    ];

    public $fillable = [
        'consultant',
        'user',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mwoller_consultmenow_rating';

    public $belongsTo = [
        'consultant' => Consultant::class,
        'user' => User::class,
    ];

    public $hasMany = [
        'criteriaratings' => [
            CriteriaRating::class,
            'delete' => true
            ]
    ];

    public function getGeneralRatingAttribute()
    {
        return round($this->criteriaratings()->avg('value'));

    }
}
