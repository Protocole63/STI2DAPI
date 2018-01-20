<?php

namespace App\Repositories;

use App\Models\Heat;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HeatRepository
 * @package App\Repositories
 * @version January 20, 2018, 4:48 pm UTC
 *
 * @method Heat findWithoutFail($id, $columns = ['*'])
 * @method Heat find($id, $columns = ['*'])
 * @method Heat first($columns = ['*'])
*/
class HeatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_id',
        'level'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Heat::class;
    }
}
