<?php

namespace App\Repositories;

use App\Models\ClientPayment;
use App\Repositories\BaseRepository;

/**
 * Class ClientPaymentRepository
 * @package App\Repositories
 * @version June 13, 2022, 8:33 pm UTC
*/

class ClientPaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'referred_code'
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
        return ClientPayment::class;
    }
}
