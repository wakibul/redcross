<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Customer;
use Validator,DB;
class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $donations = Donation::with('country','state')->paginate();
        if(!$donations->isEmpty())
        return response()->json(['success'=>true,'donations'=>$donations]);
        else
        return response()->json(['success'=>false]);
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
            'donation_type' => 'required',
            'name' => 'required',
            'age'=> 'required',
            'sex'=> 'required',
            'address'=> 'required',
            'village_town'=> 'required',
            'district'=> 'required',
            'pincode'=> 'required|numeric',
            'mobile'=> 'required|numeric',
            'country_id'=> 'required',
            'state_id'=> 'required',
            'donation_amount'=> 'required',
            'donation_purpose'=> 'required',
            'pan_no'=> 'required'
		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        DB::beginTransaction();
        try {
            $data['name'] = $request->name;
            $data['donation_type'] = $request->donation_type;
            $data['blood_group'] = $request->blood_group;
            $data['customer_id'] = auth('api')->user()->id;
            $data['age'] = $request->age;
            $data['sex'] = $request->sex;
            $data['address'] = $request->address;
            $data['village_town'] = $request->village_town;
            $data['district'] = $request->district;
            $data['pincode'] = $request->pincode;
            $data['mobile'] = $request->mobile;
            $data['email'] = $request->email;
            $data['country_id'] = $request->country_id;
            $data['state_id'] = $request->state_id;
            $data['donation_amount'] = $request->donation_amount;
            $data['donation_purpose'] = $request->donation_purpose;
            $data['pan_no'] = $request->pan_no;
            $donation = Donation::create($data);
            $request_id = "IND/REDCROSS/DONATION/".$donation->id;
            Donation::where('id',$donation->id)->update(['donation_request_id'=>$request_id]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['success'=>false,'error'=>$e->getMessage()]);

        }
        
        DB::commit();  
	    return response()->json(['success'=>true,'msg'=>'Thank you ! We will get back to you shortly.Your donation request id is '. $request_id,'request_id'=>$request_id]);
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
    }
}
