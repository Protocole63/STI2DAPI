<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Data
 * @package App\Models
 * @version January 20, 2018, 4:28 pm UTC
 */
class Data extends Model
{
    use SoftDeletes;

    public $table = 'data';
    

    protected $dates = ['deleted_at'];


    public $fillable = [ 
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function heat() {
        return $this->hasOne('App\Models\Heat', 'data_id', 'id');
    }

    public function food() {
        return $this->hasOne('App\Models\Food', 'data_id', 'id');
    }

    public function acid() {
        return $this->hasOne('App\Models\Acid', 'data_id', 'id');
    }

    
}
