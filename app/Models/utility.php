<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class utility
 * @package App\Models
 * @version August 24, 2019, 5:02 am UTC
 *
 * @property string name
 * @property string image
 * @property string address
 */
class utility extends Model
{
    use SoftDeletes;

    public $table = 'utilities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'address'
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
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
