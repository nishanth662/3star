<?php

namespace App\Repositories;

use App\Models\sportsImage;
use App\Repositories\BaseRepository;

/**
 * Class sportsImageRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:33 am UTC
*/

class sportsImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sports_id',
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
        return sportsImage::class;
    }
}
