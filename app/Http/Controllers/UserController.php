<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('can:view,user')->only(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Reset password of the specified resource.
     *
     * @param ResetPasswordRequest $request
     * @return mixed
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $filteredRequest = $request->only('new_password', 'token');
        return $this->userService->resetPassword($filteredRequest);
    }

    /**
     * Request password reset.
     *
     * @param ForgotPasswordRequest $request
     * @return mixed
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $filteredRequest = $request->only('email');
        return $this->userService->sendPasswordResetLink($filteredRequest);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
