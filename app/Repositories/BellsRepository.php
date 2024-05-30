<?php

namespace App\Repositories;

use App\Models\Bells;
use App\Repositories\BaseRepository;

/**
 * Class BellsRepository
 * @package App\Repositories
 * @version April 8, 2022, 6:44 am UTC
*/

class BellsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'notification'
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
        return Bells::class;
    }
}
