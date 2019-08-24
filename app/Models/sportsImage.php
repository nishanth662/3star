<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sportsImage
 * @package App\Models
 * @version August 24, 2019, 6:33 am UTC
 *
 * @property string sports_id
 * @property string image
 */
class sportsImage extends Model
{
    use SoftDeletes;

    public $table = 'sports_images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'sports_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sports_id' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function sports()
    {
        return $this->belongsTo('App\Models\sports');
    }
    
}
