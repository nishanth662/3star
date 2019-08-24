<?php

namespace App\Repositories;

use App\Models\sports_events;
use App\Repositories\BaseRepository;

/**
 * Class sports_eventsRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:03 am UTC
*/

class sports_eventsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'ground',
        'date',
        'time',
        'price',
        'image'
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
        return sports_events::class;
    }
}
