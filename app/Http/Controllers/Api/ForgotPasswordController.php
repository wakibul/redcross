<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Validator,DB;
class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        $customer = Customer::where([['mobile',$request->mobile],['status',1]])->first();
        $otp = mt_rand(100000, 999999);
        if($customer){
            sendNewSMS($request->mobile,"<#> Your otp verification code is ".$otp." WTWOacQ0DBF");
            Customer::where('mobile',$request->mobile)->update(['otp'=>$otp]);
            return response()->json(['success'=>true,'message'=>'Otp sent succesfully','otp'=>$otp,'mobile'=>$request->mobile]);
        }
        else{
            return response()->json(['success'=>false,'error'=>'Phone no does not exist']);
        }

    }

    public function validateOtp(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'otp' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'msg'=>$validator->errors()]);
        }
        $customer = Customer::where([['mobile',$request->mobile],['status',1]])->first();
        if($customer){
            $otp = $customer->otp;
            if($otp == $request->otp){
                return response()->json(['success'=>true,'message'=>'Otp validated successfully']);
            }
            else{
                return response()->json(['success'=>false,'msg'=>'Wrong OTP']);
            }

        }
        else{
            return response()->json(['success'=>false,'msg'=>'Otp is not valid']);
        }

}

 public function changePassword(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'password'=> 'required|min:6|confirmed',
            'fcm_token'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        $customer = Customer::where([['mobile',$request->mobile],['status',1]])->first();
        if($customer){
            Customer::where('mobile',$request->mobile)->update(['password'=>bcrypt($request->password),'fcm_token'=>$request->fcm_token]);
            $credentials = $request->only('mobile', 'password');
            $credentials['status'] = 1;
             try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = auth('api')->attempt($credentials)) {
                    return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials.']);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }
        // all good so return the token
            return response()->json(['success' => true, 'token' => $token,'message'=>'Password changed successfully','user' => [
                            'id'            => auth('api')->user()->id,
                            'name'          => auth('api')->user()->name,
                            'email'         => auth('api')->user()->email,
                            'mobile'         => auth('api')->user()->mobile,
                            'gender'         => auth('api')->user()->gender,
                            'is_member'         => auth('api')->user()->is_member,
                            'member_package_id'         => auth('api')->user()->member_package_id,
                            'device_id'         => auth('api')->user()->device_id
                    ] ]);
            }
            else{
                return response()->json(['success'=>false,'error'=>'user does not exist']);
            }

}

public function resendOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile'=> 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }
        if (Customer::where([['mobile', '=', $request->mobile],['status',1]])->exists()) {
                $otp = mt_rand(100000, 999999);
                try{
                    $update = Customer::where('mobile',$request->mobile)->update(['otp'=>$otp]);
                    sendNewSMS($request->mobile,"Your otp verification code is ".$otp);
                    return response()->json(['success'=>true,'msg'=>'Otp sent successfully']);
                }
                catch(\Exception $e){
                    return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
                }


            }
            else{
                return response()->json(['success'=>false,'error'=>'The phone no does not exist']);
            }

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
    }
}
