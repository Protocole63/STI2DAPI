<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Acid
 * @package App\Models
 * @version January 20, 2018, 4:55 pm UTC
 *
 * @property integer data_id
 * @property integer level
 */
class Acid extends Model
{
    use SoftDeletes;

    public $table = 'acids';
    protected $primaryKey = 'data_id';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'data_id',
        'level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_id' => 'integer',
        'level' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'data_id' => 'numeric',
        'level' => 'numeric'
    ];

    
}
