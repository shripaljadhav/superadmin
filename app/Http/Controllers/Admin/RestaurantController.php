<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Admin;
use App\UserRole;
use App\RestaurantMeta;
use App\Hour;
use Auth;
use Config;

class RestaurantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {	
        $this->middleware('auth:admin');
	}
	/**
     * All Cms Page.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		
		$query 		= Admin::where('role', '=', '7');
		
		$totalData 	= $query->count();	//for all data
		
		if ($request->has('search_term')) 
		{
			$search_term 		= 	$request->input('search_term');
			if(trim($search_term) != '')
			{		
				$query->where('title', 'LIKE', '%' . $search_term . '%');
			}
		}
		
		if ($request->has('search_term') || $request->has('search_term_from') || $request->has('search_term_to')) 
		{
			$totalData 	= $query->count();//after search
		}
		
		$lists		= $query->orderby('id','DESC')->paginate(20);
		
		return view('Admin.restaurant.index',compact(['lists', 'totalData']));	
	} 
	 
	public function create(Request $request)
	{
		return view('Admin.restaurant.create');	
	}
	
	public function store(Request $request)
	{
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
				'restaurant_name' => 'required|max:255',
				'phone' => 'required',
				'address_1' => 'required|max:255',
				'contact_email' => 'required|max:255|unique:admins,email',
				
				'zipcode' => 'required|max:255',
				'contact_name' => 'required|max:255',
				'password' => 'required|max:255',
				'contact_phone' => 'required|max:255'
			  ]);
			
			$requestData 		= 	$request->all();
			
			$obj				= 	new Admin;
			$obj->company_name	=	@$requestData['restaurant_name'];
			$obj->first_name	=	@$requestData['contact_name'];
			$obj->contact_phone	=	@$requestData['contact_phone'];
			$url = preg_replace("(^https?://)", "", @$requestData['company_website'] );
			$obj->company_website	=	@$url;
			$obj->phone			=	@$requestData['phone'];
			$obj->address		=	@$requestData['address_1'];
			$obj->maps_address		=	@$requestData['maps_address'];
			$obj->latitude		=	@$requestData['latitude'];
			$obj->longitude		=	@$requestData['longitude'];
			$obj->email			=	@$requestData['contact_email'];
			$obj->password		=	Hash::make(@$requestData['password']); 
			$obj->role			=	7;
			$obj->suit			=	@$requestData['suit'];
			$obj->city			=	@$requestData['city'];
			$obj->country		=	@$requestData['country_id'];
			$obj->state			=	@$requestData['state'];
			$obj->zip			=	@$requestData['zipcode'];
			$obj->status		=	@$requestData['status'];
			
			
			/* Profile Image Upload Function Start */						  
					if($request->hasfile('profile_img')) 
					{	
						$profile_img = $this->uploadFile($request->file('profile_img'), Config::get('constants.profile_imgs'));
					}
					else
					{
						$profile_img = NULL;
					}		
				/* Profile Image Upload Function End */	
				/* Profile Image Upload Function Start */						  
					if($request->hasfile('logo_img')) 
					{	
						$profile_logo = $this->uploadFile($request->file('logo_img'), Config::get('constants.profile_logo'));
					}
					else
					{
						$profile_logo = NULL;
					}		
				/* Profile Image Upload Function End */
			$obj->profile_img			=	@$profile_img;
			$obj->logo			=	@$profile_logo;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_1', @$requestData['cuisine_1']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_2', @$requestData['cuisine_2']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_3', @$requestData['cuisine_3']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'hour_of_operation', @$requestData['hour_of_operation']);
				
				$this->update_user_meta('restaurant_metas', $obj->id, 'best_time_contact', @$requestData['best_time_contact']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'who_pay_fee', @$requestData['who_pay_fee']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'custome_order_large_price', @$requestData['custome_order_large_pric']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'sale_tax', @$requestData['sale_tax']);
				if(isset($requestData['res_deliver']) && $requestData['res_deliver'] == 1){
					$this->update_user_meta('restaurant_metas', $obj->id, 'res_deliver', @$requestData['res_deliver']);
					$this->update_user_meta('restaurant_metas', $obj->id, 'delivery_note', @$requestData['delivery_note']);
				}
				
				return Redirect::to('/restaurant/hours/'.base64_encode(convert_uuencode(@$obj->id)))->with('success', 'Restaurant added Successfully');
			}				
		}			
	}
	
	public function edit(Request $request, $id = NULL)
	{	
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			
			if(@$requestData['password'] != '')
			{
				$this->validate($request, [
					'restaurant_name' => 'required|max:255',
					'phone' => 'required',
					'address_1' => 'required|max:255',
					'contact_email' => 'required|max:255|unique:admins,email,'.$requestData['id'],
					'city' => 'required|max:255',
					'zipcode' => 'required|max:255',
					'contact_name' => 'required|max:255',
					'password' => 'required|max:255',
					'contact_phone' => 'required|max:255'
				  ]);
			}else{
				$this->validate($request, [
					'restaurant_name' => 'required|max:255',
					'phone' => 'required',
					'address_1' => 'required|max:255',
					'contact_email' => 'required|max:255|unique:admins,email,'.$requestData['id'],
					'city' => 'required|max:255',
					'zipcode' => 'required|max:255',
					'contact_name' => 'required|max:255',
					'contact_phone' => 'required|max:255'

				  ]);
			}
			//$requestData 		= 	$request->all();
			
			$obj				= 	 Admin::find($requestData['id']);
			$obj->company_name	=	@$requestData['restaurant_name'];
			$obj->first_name	=	@$requestData['contact_name'];
			$obj->contact_phone	=	@$requestData['contact_phone'];
			$obj->phone			=	@$requestData['phone'];
			$obj->address		=	@$requestData['address_1'];
			$obj->maps_address		=	@$requestData['maps_address'];
			$obj->latitude		=	@$requestData['latitude'];
			$obj->longitude		=	@$requestData['longitude'];
			$url = preg_replace("(^https?://)", "", @$requestData['company_website'] );
			$obj->company_website	=	@$url;
			$obj->email			=	@$requestData['contact_email'];
			if(!empty(@$requestData['password']))
			{		
			$obj->password		=	Hash::make(@$requestData['password']);
			}
			$obj->role			=	7;
			$obj->suit			=	@$requestData['suit'];
			$obj->city			=	@$requestData['city'];
			$obj->country		=	@$requestData['country_id'];
			$obj->state			=	@$requestData['state'];
			$obj->zip			=	@$requestData['zipcode'];
			$obj->status		=	@$requestData['status'];
			
			/* Profile Image Upload Function Start */						  
			if($request->hasfile('profile_img')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['profile_img'] != '')
					{
						$this->unlinkFile($requestData['old_profile_img'], Config::get('constants.profile_imgs'));
					}
				/* Unlink File Function End */
				$profile_img = $this->uploadFile($request->file('profile_img'), Config::get('constants.profile_imgs'));
			}
			else
			{
				$profile_img = @$requestData['old_profile_img'];
			}		
			
			/* Profile Logo Upload Function Start */						  
			if($request->hasfile('logo_img')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['logo_img'] != '')
					{
						$this->unlinkFile($requestData['old_logo_img'], Config::get('constants.profile_logo'));
					}
				/* Unlink File Function End */
				$profile_logo = $this->uploadFile($request->file('logo_img'), Config::get('constants.profile_logo'));
			}
			else
			{
				$profile_logo = @$requestData['old_logo_img'];
			}	
				/* Profile Logo Upload Function End */	
			$obj->profile_img			=	@$profile_img;
			$obj->logo			=	@$profile_logo;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_1', @$requestData['cuisine_1']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_2', @$requestData['cuisine_2']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'cuisine_3', @$requestData['cuisine_3']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'hour_of_operation', @$requestData['hour_of_operation']);
				
				$this->update_user_meta('restaurant_metas', $obj->id, 'best_time_contact', @$requestData['best_time_contact']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'who_pay_fee', @$requestData['who_pay_fee']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'custome_order_large_price', @$requestData['custome_order_large_pric']);
				$this->update_user_meta('restaurant_metas', $obj->id, 'sale_tax', @$requestData['sale_tax']);
				if(isset($requestData['res_deliver']) && $requestData['res_deliver'] == 1){
					$this->update_user_meta('restaurant_metas', $obj->id, 'res_deliver', @$requestData['res_deliver']);
					$this->update_user_meta('restaurant_metas', $obj->id, 'delivery_note', @$requestData['delivery_note']);
				}
				return Redirect::to('/restaurants')->with('success', 'Restaurant added Successfully');
			}				
		}	
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Admin::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Admin::find($id);
					return view('Admin.restaurant.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/restaurants')->with('error', 'Restaurant '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/restaurants')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
	
	public function hours(Request $request, $rid){
		if(isset($rid) && !empty($rid))
			{
				$id = $this->decodeString($rid);	
				if(Admin::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Admin::find($id);
					return view('Admin.restaurant.hour', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/restaurants')->with('error', 'Restaurant '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/restaurants')->with('error', Config::get('constants.unauthorized'));
			}
	}
	
	public function addHour(Request $request)
	{
		$openTime = $request->openTime;
		$closeTime = $request->closeTime;
		$user_id = $request->user_id;
		$day = $request->day;
		$type = $request->type;
		if($request->has('hourId')){
			$requestid = $this->decodeString($request->hourId);	
			$obj = Hour::find($requestid);
		}else{
			$obj = new Hour;
		}
		
		$obj->day = $day;
		$obj->opentime = $openTime;
		$obj->closetime = $closeTime;
		$obj->hour_type = $type;
		$obj->user_id = $user_id;
		$saved = $obj->save();
		if($saved){
			echo json_encode(array('success'=>true, 'hourId'=>base64_encode(convert_uuencode($obj->id)),'openTime'=>$obj->openTime, "closeTime"=>$obj->closetime,'openTimef'=>date('h:i A',strtotime($obj->opentime)), "closeTimef"=>date('h:i A',strtotime($obj->closetime)))); 
		}else{
			echo json_encode(array('success'=>false, 'msg'=>"Please try again")); 
		}
		
		exit;		
	}
	
	public function RemoveHour(Request $request, $id){
		$id = $this->decodeString($id);
		$queryexist = Hour::where('id', $id)->where('user_id', $user_id)->exists();
		if($queryexist){
			$queryremove = Hour::where('id', $id)->where('user_id', $user_id)->delete();
			if($queryremove){
				echo json_encode(array('success'=>true, 'msg'=>"deleted successfully"));
			}else{
				echo json_encode(array('success'=>false, 'msg'=>"Please try again"));
			}
		}else{
			echo json_encode(array('success'=>false, 'msg'=>"Please try again"));
		}
		exit;
	}
}
