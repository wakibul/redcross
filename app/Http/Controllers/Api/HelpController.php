<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use App\Customer;
use Validator,DB;
class HelpController extends Controller
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
            'blood_donation'=> 'required',
            'relief'=> 'required',
            'medical_assistance'=> 'required',
            'message'=> 'required'
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
            $data['blood_donation'] = $request->blood_donation;
            $data['relief'] = $request->relief;
            $data['medical_assistance'] = $request->medical_assistance;
            $data['message'] = $request->message;
            $help = Help::create($data);
            $request_id = "IND/REDCROSS/HELP/".$help->id;
            Help::where('id',$help->id)->update(['help_request_id'=>$request_id]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['success'=>false,'error'=>$e->getMessage()]);

        }
        DB::commit();  
	    return response()->json(['success'=>true,'msg'=>'Thank you ! We will get back to you shortly. Your help request id is '. $request_id,'request_id'=>$request_id]);
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
