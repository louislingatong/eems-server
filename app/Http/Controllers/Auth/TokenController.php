<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->user()->token()->revoke();
        $this->response['isAuthenticated'] = false;

        return response()->json($this->response, 200);
    }
}
