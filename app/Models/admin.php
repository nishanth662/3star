<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class admin
 * @package App\Models
 * @version August 24, 2019, 5:58 am UTC
 *
 * @property string name
 * @property string email
 * @property string sports
 */
class admin extends Model
{
    use SoftDeletes;

    public $table = 'admins';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'sports'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'sports' => 'string',
        'password'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'sports_id' => 'required',
    ];

    
}
