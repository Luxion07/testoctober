<?php namespace Vanya\Models;

use Model;

/**
 * Tides Model
 */
class Tides extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'tides_info';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['max','max_time','min','min_time'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
