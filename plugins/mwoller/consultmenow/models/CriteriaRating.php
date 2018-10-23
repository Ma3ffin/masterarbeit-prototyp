<?php namespace Mwoller\Consultmenow\Models;

use Model;

/**
 * Model
 */
class CriteriaRating extends Model
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
    ];

    public $fillable = [
        'rating',
        'criteria',
        'value'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mwoller_consultmenow_criteria_rating';

    public $belongsTo = [
        'rating' => Rating::class,
        'criteria' => Criteria::class,
    ];
}
