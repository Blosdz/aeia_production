<?php

namespace App\Repositories;

use App\Models\Declaraciones;
use App\Repositories\BaseRepository;

/**
 * Class ContractRepository
 * @package App\Repositories
 * @version April 26, 2022, 8:31 am UTC
*/

class DeclaracionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Declaraciones::class;
    }
}
