<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sports
 * @package App\Models
 * @version August 24, 2019, 6:02 am UTC
 *
 * @property string name
 * @property string image
 * @property string location
 */
class sports extends Model
{
    use SoftDeletes;

    public $table = 'sports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'location'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'location' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'location' => 'required',
    ];

    public function images()
    {
        return $this->hasMany('App\Models\sportsImage');
    }
    public function user()
    {
        $this->belongsTo('App\User','sports_id','id');
    }
    public function events()
    {
        return $this->hasMany('App\Models\sports_event','ground','id');
    }
}
