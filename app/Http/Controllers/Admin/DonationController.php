<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Donation;
use Crypt,Redirect,Auth;
use PDF;
use Excel;
use App\Exports\DonationExport;
class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cashDonation(Request $request)
    {
        //
        $states = State::where('status',1)->get();
        $donations = Donation::with('customer','state')->where('donation_type',1);
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
        return view('admin.donation.cash-donation',compact('donations','states'));

    }

    public function ajaxInfo(Request $request)
    {
        //
        $donation = Donation::with('customer','state')->where('id',$request->id)->first();
        return response()->json($donation);
    }

    public function bloodDonation(Request $request)
    {
        //
        $states = State::where('status',1)->get();
        $donations = Donation::with('customer','state')->where('donation_type',2);
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
        return view('admin.donation.blood-donation',compact('donations','states'));

    }

    public function pdf($id)
    {
        //
        $id = Crypt::decrypt($id);
        $donation = Donation::where('id',$id)->first();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('admin.donation.pdf', compact('donation'));
        $filename = str_replace("/","-",strtolower($donation->donation_request_id));
        return $pdf->download($filename.'.pdf');
        //return view('admin.help.pdf',compact('help'));
    }

    public function cashPdf($id)
    {
        //
        $id = Crypt::decrypt($id);
        $donation = Donation::where('id',$id)->first();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('admin.donation.pdf', compact('donation'));
        $filename = str_replace("/","-",strtolower($donation->donation_request_id));
        return $pdf->download($filename.'.pdf');
        //return view('admin.help.pdf',compact('help'));
    }

    public function exportDonation(Request $request)
    {
        //
        $donations = Donation::with('customer','state')->where('donation_type',1);
        if ($request->state_id) {
            $donations->where('state_id',$request->state_id);
        }
        if ($request->from_date) {
            $donations->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $donations->whereDate('created_at','<=',$request->to_date);
        }
        $donations = $donations->paginate();
        return Excel::download(new DonationExport($donations), 'donations.xlsx');
        //return view('admin.donation.blood-donation',compact('donations','states'));
    }

    public function exportBloodDonation(Request $request)
    {
        //
        $donations = Donation::with('customer','state')->where('donation_type',2);
        if ($request->state_id) {
            $donations->where('state_id',$request->state_id);
        }
        if ($request->from_date) {
            $donations->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $donations->whereDate('created_at','<=',$request->to_date);
        }
        $donations = $donations->paginate();
        return Excel::download(new DonationExport($donations), 'donations.xlsx');
        //return view('admin.donation.blood-donation',compact('donations','states'));
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
