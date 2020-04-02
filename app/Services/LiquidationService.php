<?php

namespace App\Services;

use App\Liquidation;
use App\LiquidationExpense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiquidationService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new liquidation.
     *
     * @param mixed $data
     *
     * @return Liquidation
     * @throws \Exception
     */
    public function add($data)
    {
        DB::beginTransaction();

        try {
            // set event owner to data array
            $data['owner_id'] = Auth::id();
            // create new event
            $liquidation = Liquidation::create($data);
            // create liquidation expense
            foreach ($data['expenses'] as $key => $value) {
                $value['liquidation_id'] = $liquidation->id;
                LiquidationExpense::create($value);
            }

            DB::commit();

            return $liquidation;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Edit the given liquidation.
     *
     * @param mixed $data
     * @param Liquidation $liquidation
     * @return Liquidation
     * @throws \Exception
     */
    public function edit($data, $liquidation)
    {
        DB::beginTransaction();

        try {
            // delete all expenses
            $liquidation->expenses()->delete();
            // update liquidation
            $liquidation->update($data);
            // create liquidation expense
            foreach ($data['expenses'] as $key => $value) {
                $value['liquidation_id'] = $liquidation->id;
                LiquidationExpense::create($value);
            }

            DB::commit();

            return $liquidation;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}