<?php

namespace Daison\BusRouterSg\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LoginAttempt extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke(Request $request)
    {
        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('bus-router-sg::welcome'));
        }
    }
}
