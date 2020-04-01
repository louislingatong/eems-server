<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'gender', 'marital_status', 'id_number',
        'employment_type', 'employment_status', 'employment_date', 'regularization_date', 'position_id', 'user_id'
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
