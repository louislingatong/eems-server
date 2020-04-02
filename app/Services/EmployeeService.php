<?php

namespace App\Services;

use App\ClubJoinTicket;
use App\Employee;
use App\Mail\AccountVerificationMail;
use App\Mail\ClubRegistrationMail;
use App\PasswordResetTicket;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new employee.
     *
     * @param mixed $data
     *
     * @return Employee
     * @throws \Exception
     */
    public function add($data)
    {
        DB::beginTransaction();

        try {
            // set name to data array
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
            // set temporary password to data array
            $data['password'] = Hash::make(str_random(8));
            // create user
            $user = User::create($data);
            // set role employee
            $user->roles()->attach(config('constants.role.employee'));
            // create employee
            $employee = new Employee($data);
            // set employee id foreign key
            $user->employee()->save($employee);
            // generate password reset token
            $data['token'] = str_random(60);
            // create password reset token
            $passwordReset = PasswordResetTicket::create($data);
            // initialize email details
            $details = [
                'name' => $user->name,
                'token' => $passwordReset->token
            ];
            // send verification link
            Mail::to($passwordReset->email)->send(new AccountVerificationMail($details));

            DB::commit();

            return $employee;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Edit the given employee.
     *
     * @param mixed $data
     * @param Employee $employee
     *
     * @return Employee
     */
    public function edit($data, $employee)
    {
        // set name to data array
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        // update employee
        $employee->update($data);
        // update user
        $employee->user()->update($data);

        return $employee;
    }

    /**
     * Edit event response state of the given Employee.
     *
     * @param mixed $data
     * @param Employee $employee
     *
     * @return Employee
     */
    public function editEventResponse($data, $employee)
    {
        $employee->events()
            ->newPivotStatement()
            ->where('id', $data['employee_event_id'])
            ->update(['event_response' => $data['employee_event_response']]);

        return $employee;
    }

    /**
     * Add new join club tickets.
     *
     * @return mixed
     * @throws
     */
    public function addJoinClubTickets()
    {
        DB::beginTransaction();

        try {
            $issuer_id = Auth::id();

            Employee::all()
                ->where('user_id', '!=', $issuer_id)
                ->map(function ($employee) {
                    $data['token'] = str_random(60);
                    $data['email'] = $employee->user()->first()->email;

                    $clubJoinTicket = ClubJoinTicket::create($data);

                    Mail::to($clubJoinTicket->email)->send(new ClubRegistrationMail($clubJoinTicket->token));
                });

            DB::commit();

            return response()->json([
                'message' => 'A join club ticket was sent to all employees.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
  
}