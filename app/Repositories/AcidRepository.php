<?php

namespace App\Repositories;

use App\Models\Acid;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AcidRepository
 * @package App\Repositories
 * @version January 20, 2018, 4:55 pm UTC
 *
 * @method Acid findWithoutFail($id, $columns = ['*'])
 * @method Acid find($id, $columns = ['*'])
 * @method Acid first($columns = ['*'])
*/
class AcidRepository extends BaseRepository
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
        return Acid::class;
    }
}
