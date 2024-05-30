<?php

namespace App\Repositories;

use App\Models\UserEvent;
use App\Repositories\BaseRepository;

/**
 * Class UserEventRepository
 * @package App\Repositories
 * @version March 1, 2022, 8:04 pm UTC
*/

class UserEventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'event_id',
        'inscription_date'
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
        return UserEvent::class;
    }
}
