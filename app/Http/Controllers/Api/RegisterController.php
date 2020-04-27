<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Exception;
use JWTFactory;
use JWTAuth,JWTException;
use Validator,DB,Str;
class RegisterController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'password'=> 'required|min:6|confirmed',
            'gender'=> 'required',
			'mobile'=> 'required|numeric',
			'device_id'=> 'required',
			'fcm_token'=>'required'
		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
		}
        $otp = mt_rand(100000, 999999);
        DB::beginTransaction();
        try 
        {
			$customerPhoneExist = Customer::where([['mobile',$request->mobile],['otp_verified','!=',null],['status',1]])->first();
			if($customerPhoneExist != null){
				return response()->json(['success'=>false,'error'=>'Phone no already exists']);
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['gender'] = $request->gender;
            $data['password'] = bcrypt($request->password);
            $data['otp'] = $otp;
            $data['device_id'] = $request->device_id;
            $data['fcm_token'] = $request->fcm_token;
            $where = ['mobile'=>$request->mobile,'otp_verified'=>null];
            $customer = Customer::updateOrCreate($where,$data);
            sendNewSMS($request->mobile,"Your otp verification code is ".$otp);
            
        } 
        catch(\Execption $e){
            DB::rollback();
			return response()->json($e->getMessage());
        }
        DB::commit();  
	    return response()->json(['success'=>true,'msg'=>'Otp sent succesfully','customer_details'=>$customer]);
    }

    public function verify(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'mobile' => 'required|numeric',
			'otp' => 'required|numeric',
		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
		}

        $customer = Customer::where([['mobile',$request->mobile],['otp_verified',null],['status',0]])->first();
		if($customer){
			if($request->otp == $customer->otp){
				$credentials = $request->only('mobile');
				$credentials['status'] = 0;
				try {

        			$token = JWTAuth::fromUser($customer);
        			$dt = date('Y-m-d H:i:s');
        			Customer::where('mobile',$request->mobile)->update(['status'=>1,'otp_verified'=>$dt]);
					return response()->json(['success' => true,'token'=>$token,'customer_details'=>['name'=>$customer->name,'mobile'=>$customer->mobile,'id'=>$customer->id]]);
				} catch (JWTException $e) {
				            // something went wrong whilst attempting to encode the token
					return response()->json(['success' => false, 'error' => 'Failed to login, please try again.']);
				}
				        // all good so return the token
			}
			else{
				return response()->json(["success"=>false,"msg"=>"Invalid Otp"]);
			}
		}
		else{
			return response()->json(["success"=>false,"msg"=>"Invalid User"]);
		}

	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'mobile'=> 'required|numeric',
            'password'=> 'required',
            'fcm_token'=> 'required'

		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
		}
		$credentials = $request->only('mobile', 'password');
		$credentials['status'] = 1;

		 try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Your username or password is incorrect']);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
		// all good so return the token
		if(auth('api')->user()->email != null){
			$r_email = auth('api')->user()->email;
		}
		else{
			$r_email = "";
        }

        Customer::where('id',auth('api')->user()->id)->update(['fcm_token'=>$request->fcm_token]);

        return response()->json(['success' => true, 'token' => $token, 'customer_details' => [
					'id'            => auth('api')->user()->id,
					'name'          => auth('api')->user()->name,
                    'email'         => $r_email,
					'mobile'         => auth('api')->user()->mobile,
					'gender'         => auth('api')->user()->gender,
					'is_member'         => auth('api')->user()->is_member,
					'member_package_id'         => auth('api')->user()->member_package_id,
					'device_id'         => auth('api')->user()->device_id
                ] ]);
	}
	
	public function resendOtp(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'mobile'=> 'required|numeric'
		]);
		if ($validator->fails()) {
			return response()->json(['success'=>false,'error'=>$validator->errors()]);
		}
		if (Customer::where([['mobile', '=', $request->mobile],['status',0]])->exists()) {
                $otp = mt_rand(100000, 999999);
                try{
                    $update = Customer::where([['mobile',$request->mobile],['status',0],['otp_verified',null]])->update(['otp'=>$otp]);
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

}
