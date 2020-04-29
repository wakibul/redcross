<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use Crypt,Redirect,Auth;
class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openHelp(Request $request)
    {
        //
        $helps = Help::with('customer')->where('status',0);
        if ($request->from_date) {
            $helps->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $helps->whereDate('created_at','<=',$request->to_date);
        }
        $helps = $helps->paginate();;
        return view('admin.help.open',compact('helps'));
    }

    public function closeHelp(Request $request)
    {
        //
        $helps = Help::with('customer')->where('status',1);
        if ($request->from_date) {
            $helps->whereDate('created_at','>=',$request->from_date);
        }

        if ($request->to_date) {
            $helps->whereDate('created_at','<=',$request->to_date);
        }
        $helps = $helps->paginate();;
        return view('admin.help.close',compact('helps'));
    }

    public function ajaxInfo(Request $request)
    {
        //
        $help = Help::with('customer')->where('id',$request->id)->first();
        return response()->json($help);
    }

    public function closeIssue($id)
    {
        //
        $id = Crypt::decrypt($id);
        $closed_at = date('Y-m-d  H:i:s');
        Help::where('id',$id)->update(['status'=>1,'closed_at'=>$closed_at,'closed_by'=>Auth::guard('admin')->user()->id]);
        return Redirect::back()->with('success', 'Closed successfully');
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
        $help = Help::where('id',$id)->first();
        $help->delete();;
        return Redirect::back()->with('success', 'Deleted !');
    }
}
