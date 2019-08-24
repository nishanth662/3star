<?php

namespace App\Repositories;

use App\Models\eventImage;
use App\Repositories\BaseRepository;

/**
 * Class eventImageRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:35 am UTC
*/

class eventImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'event_id',
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
        return eventImage::class;
    }
}
