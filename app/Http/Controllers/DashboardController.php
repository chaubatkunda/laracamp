<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        switch (Auth::user()->is_admin) {
            case true:
                $checkouts = Checkout::get();
                break;
            default:
                $checkouts = Checkout::whereUserId(Auth::id())->get();
                break;
        }
        return view('dashboard', [
            'checkouts'     => $checkouts
        ]);
    }
}
