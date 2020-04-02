<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiquidationExpense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'particulars', 'amount', 'issue_date', 'liquidation_id',
    ];

    /**
     * Get liquidation record associated with the expense.
     *
     * @return mixed
     */
    public function liquidation()
    {
        return $this->belongsTo('App\Liquidation');
    }
}
