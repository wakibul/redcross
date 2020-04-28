<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Customer;
use Validator,DB;

class MemberController extends Controller
{
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
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'age'=> 'required',
            'sex'=> 'required',
            'address'=> 'required',
            'village_town'=> 'required',
            'district'=> 'required',
            'pincode'=> 'required|numeric',
            'mobile'=> 'required|numeric',
            'voluntary_service'=> 'required',
            'member_package_id'=> 'required|numeric'
		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        DB::beginTransaction();
        try {
            $data['name'] = $request->name;
            $data['customer_id'] = auth('api')->user()->id;
            $data['age'] = $request->age;
            $data['sex'] = $request->sex;
            $data['address'] = $request->address;
            $data['village_town'] = $request->village_town;
            $data['district'] = $request->district;
            $data['pincode'] = $request->pincode;
            $data['mobile'] = $request->mobile;
            $data['email'] = $request->email;
            $data['voluntary_service'] = $request->voluntary_service;
            $data['member_package_id'] = $request->member_package_id;
            $member = Member::create($data);
            $request_id = "IND/REDCROSS/MEM/".$member->id;
            Member::where('id',$member->id)->update(['member_request_id'=>$request_id]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['success'=>false,'error'=>$e->getMessage()]);

        }
        DB::commit();  
	    return response()->json(['success'=>true,'msg'=>'Applied succesfully','request_id'=>$request_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkMember()
    {
        //
        $is_member = Member::with('memberPackage')->where('customer_id',auth('api')->user()->id)->first();
        if($is_member != null){
            return response()->json(['success'=>true,'status'=>$is_member->status,'status_comment'=>[
                '0' => 'Applied for',
                '1' => 'Confirmed',
                '2' => 'Cancelled',
                '9' => 'Not applied'
            ],'customer_details'=>$is_member]);
        }else{
            return response()->json(['success'=>true,'status'=>9,'status_comment'=>[
                '0' => 'Applied for',
                '1' => 'Confirmed',
                '2' => 'Cancelled',
                '9' => 'Not applied'
            ]]);
        }
            
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
    }
}
