<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class eventImage
 * @package App\Models
 * @version August 24, 2019, 6:35 am UTC
 *
 * @property string event_id
 * @property string image
 */
class eventImage extends Model
{
    use SoftDeletes;

    public $table = 'event_images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'event_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'event_id' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function sports_events()
    {
        return $this->belongsTo('App\Models\sports_events','event_id','id');
    }
    
}
