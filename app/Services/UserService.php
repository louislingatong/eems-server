<?php

namespace App\Services;

use App\Mail\PasswordResetMail;
use App\PasswordResetTicket;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Reset the given user's password.
     *
     * @param mixed $data
     * @throws
     */
    public function resetPassword($data)
    {
        // retrieve password reset ticket by token
        $passwordResetTicket = PasswordResetTicket::where('token', $data['token'])->first();
        // retrieve user by email
        $users = User::where('email', $passwordResetTicket->email)->first();
        // update user password
        $users->update(['password' => Hash::make($data['new_password'])]);
        // delete password reset
        $passwordResetTicket->delete();
    }

    /**
     * Send a password reset link to the given user.
     *
     * @param mixed $data
     * @throws \Exception
     */
    public function sendPasswordResetLink($data)
    {
        DB::beginTransaction();

        try {
            // generate password reset ticket
            $data['token'] = str_random(60);
            $passwordResetTicket = PasswordResetTicket::create($data);
            // send reset password link
            Mail::to($passwordResetTicket->email)->send(new PasswordResetMail($passwordResetTicket->token));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}