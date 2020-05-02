<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Customer;
use App\Models\MemberPackage;
use Crypt,Redirect,Auth;
use PDF;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved(Request $request)
    {
        //
        $memberPackages = MemberPackage::where('status',1)->get();
        $members = Member::with('customer','memberPackage')->where('status',1);
        if ($request->member_package_id) {
            $members->where('member_package_id',$request->member_package_id);
        }
       
        if ($request->from_date) {
            $members->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $members->whereDate('created_at','<=',$request->to_date);
        }
        $members = $members->paginate();;
        return view('admin.member.approved',compact('members','memberPackages'));
    }

    public function pending(Request $request)
    {
        //
        $memberPackages = MemberPackage::where('status',1)->get();
        $members = Member::with('customer','memberPackage')->where('status',0);
        if ($request->member_package_id) {
            $members->where('member_package_id',$request->member_package_id);
        }

        if ($request->from_date) {
            $members->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $members->whereDate('created_at','<=',$request->to_date);
        }
        $members = $members->paginate();;
        return view('admin.member.pending',compact('members','memberPackages'));
    }

    public function ajaxInfo(Request $request)
    {
        //
        $members = Member::with('customer','memberPackage')->where('id',$request->id)->first();
        return response()->json($members);
    }

    public function approveMember($id)
    {
        //
        $id = Crypt::decrypt($id);
        $approve_at = date('Y-m-d  H:i:s');
        Member::where('id',$id)->update(['status'=>1,'approve_at'=>$approve_at,'approve_by'=>Auth::guard('admin')->user()->id]);
        $member = Member::findOrFail($id);
        Customer::where('id',$member->customer_id)->update(['is_member'=>1,'member_package_id'=>$member->member_package_id]);
        return Redirect::back()->with('success', 'Approved successfully');
    }

    public function cancelMember($id)
    {
        //
        $id = Crypt::decrypt($id);
        $members = Member::where('id',$id)->update(['status'=>0]);
        return Redirect::back()->with('success', 'Membership Cancelled');
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
        $member = Member::where('id',$id)->first();
        $member->delete();;
        return Redirect::back()->with('success', 'Member Deleted !');
    }

    public function pdf($id)
    {
        //
        $id = Crypt::decrypt($id);
        $member = Member::where('id',$id)->with('customer','memberPackage')->first();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('admin.member.pdf', compact('member'));
        $filename = str_replace("/","-",strtolower($member->member_request_id));
        return $pdf->download($filename.'.pdf');
        //return view('admin.help.pdf',compact('help'));
    }
}
