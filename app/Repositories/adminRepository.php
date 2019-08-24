<?php

namespace App\Repositories;

use App\Models\admin;
use App\Repositories\BaseRepository;

/**
 * Class adminRepository
 * @package App\Repositories
 * @version August 24, 2019, 5:58 am UTC
*/

class adminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'sports'
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
        return admin::class;
    }
}
