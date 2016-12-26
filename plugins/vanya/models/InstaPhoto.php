<?php namespace Vanya\Models;

use Model;

/**
 * InstaPhoto Model
 */
class InstaPhoto extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'insta_photos';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['src'];

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
