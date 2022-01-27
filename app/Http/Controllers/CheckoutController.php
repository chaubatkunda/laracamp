<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Mail\UserAfterCheckOut;
use App\Models\Camp;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Camp $camp, Request $request)
    {
        if ($camp->isRegistrated) {
            $request->session()
                ->flash('error', "You are Registrated on {$camp->title} camp.");
            return redirect()->route('dashboard');
        }
        return view('checkout', compact('camp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckOutRequest $request, Camp $camp)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['camp_id']    = $camp->id;

        // update user
        $user = Auth::user();
        $user->email = $data['email'];
        $user->name = $data['fullname'];
        $user->occupation = $data['occupation'];
        $user->save();

        $checkout = Checkout::create($data);

        Mail::to(Auth::user()->email)->send(new UserAfterCheckOut($checkout));
        return redirect()->route('checkout.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    // public function checkeranjang(Camp $camp)
    // {
    //     return view('checkout', compact('camp'));
    // }

    public function success(Request $request, Camp $camp)
    {
        return view('success');
    }

    public function invoice()
    {
        return "Ok";
    }
}
