<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Donation;
use Crypt,Redirect,Auth;
class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $states = State::where('status',1)->get();
        $donations = Donation::with('customer','state')->where('status',0);
        if ($request->state_id) {
            $donations->where('state_id',$request->state_id);
        }
        if ($request->from_date) {
            $donations->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $donations->whereDate('created_at','<=',$request->to_date);
        }
        $donations = $donations->paginate();;
        return view('admin.donation.index',compact('donations','states'));

    }

    public function ajaxInfo(Request $request)
    {
        //
        $donation = Donation::with('customer','state')->where('id',$request->id)->first();
        return response()->json($donation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id = Crypt::decrypt($id);
        $donation = Donation::where('id',$id)->first();
        $donation->delete();;
        return Redirect::back()->with('success', 'Deleted !');
    }
}
