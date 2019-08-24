<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sports_events
 * @package App\Models
 * @version August 24, 2019, 6:03 am UTC
 *
 * @property string name
 * @property string ground
 * @property string date
 * @property string time
 * @property string price
 * @property string image
 */
class sports_events extends Model
{
    use SoftDeletes;

    public $table = 'sports_events';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'ground',
        'date',
        'time',
        'price',
        'image',
        'end_date',
        'date_time',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'ground' => 'string',
        'date' => 'string',
        'time' => 'string',
        'price' => 'string',
        'image' => 'string',
        'end_date' => 'string',
        'date_time' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'ground' => 'required',
        'date' => 'required',
        'time' => 'required',
        'price' => 'required',
    ];

    public function images()
    {
        return $this->hasMany('App\Models\eventImage','event_id','id');
    }
    public function sports()
    {
        return $this->belongsTo('App\Models\sports','ground','id');
    }
    
}
