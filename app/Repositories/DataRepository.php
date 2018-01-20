<?php

namespace App\Repositories;

use App\Models\Data;
use InfyOm\Generator\Common\BaseRepository;

class DataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Data::class;
    }
}
