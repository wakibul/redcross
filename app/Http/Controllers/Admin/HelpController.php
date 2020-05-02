<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use App\Models\HelpTransaction;
use Crypt,Redirect,Auth,Validator,DB;
use PDF;
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
        $helps = Help::with('customer')->where('status','!=','2');
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
        $helps = Help::with('customer')->where('status',2);
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
        $help = Help::with(['customer','helpTransactions'=>function($query){
            $query->orderBy('id','desc');
        }])->where('id',$request->id)->first();
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
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'help_id' => 'required|numeric',
            'status' => 'required|numeric',
            'remarks'=> 'required'
		]);
		if ($validator->fails()) {
			return Redirect::back()->with('error', $validator->errors());
        }
        $data['help_id'] = $request->help_id;
        $data['status'] = $request->status;
        $data['remarks'] = $request->remarks;
        $closed_at = date('Y-m-d  H:i:s');
        DB::beginTransaction();
        try{
            Help::where('id',$request->help_id)->update(['status'=>$request->status,'closed_at'=>$closed_at]);
            HelpTransaction::create($data);
            DB::commit();
        }
        catch(\Exception $e){
            \Log::error($e);
            DB::rollback();
            return Redirect::back()->with('error', $e->getMessage());
        }
        return Redirect::back()->with('success', "Status updated successfully");
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

    public function pdf($id)
    {
        //
        $id = Crypt::decrypt($id);
        $data = Help::with('customer')->where('id',$id)->first();
        $pdf = PDF::loadView('admin.help.pdf', compact('data'));
        return $pdf->download('customers.pdf');
        //return view('admin.help.pdf',compact('help'));
    }
}
