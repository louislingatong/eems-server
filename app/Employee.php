<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'birth_date',
        'marital_status',
        'employment_date',
        'employment_status',
        'employment_type',
        'id_number',
        'regularization_date',
        'position_id',
        'user_id',
    ];

    /**
     * Get user record associated with the employee.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get position record associated with the employee.
     *
     * @return mixed
     */
    public function position()
    {
        return $this->belongsTo('App\Position');
    }
}
