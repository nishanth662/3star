<?php

namespace App\Repositories;

use App\Models\sports;
use App\Repositories\BaseRepository;

/**
 * Class sportsRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:02 am UTC
*/

class sportsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'location'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return sports::class;
    }
}
