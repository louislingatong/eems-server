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
     * @return mixed
     */
    public function resetPassword($data)
    {
        DB::beginTransaction();

        try {
            // retrieve password reset ticket by token
            $passwordResetTicket = PasswordResetTicket::where('token', $data['token'])->first();
            // retrieve user by email
            $users = User::where('email', $passwordResetTicket->email)->first();
            // update user password
            $users->update(['password' => Hash::make($data['new_password'])]);
            // delete password reset
            $passwordResetTicket->delete();

            DB::commit();

            return response()->json([
                'message' => 'Reset password successfully.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Send a password reset link to the given user.
     *
     * @param mixed $data
     * @return mixed
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

            return response()->json([
                'message' => 'Password reset link was sent to you email.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}