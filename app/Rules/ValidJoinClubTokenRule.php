<?php

namespace App\Rules;

use App\ClubJoin;
use App\ClubJoinTicket;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidJoinClubTokenRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ClubJoinTicket::where('token', $value)
                ->where('created_at', '>', Carbon::now()->subHour(1)->toDateTimeString())
                ->count() === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The token is invalid.';
    }
}
