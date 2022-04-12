<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Admin;
use App\UserRole;
use App\UserType;
 
use Auth;
use Config;

class UserController extends Controller
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
     * All Vendors.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
	
		$query 		= Admin::where('role', '!=', '1')->Where('role', '!=', '7')->with(['usertype']); 
		  
		$totalData 	= $query->count();	//for all data

		$lists		= $query->sortable(['id' => 'desc'])->paginate(config('constants.limit'));
		
		return view('Admin.users.index',compact(['lists', 'totalData']));	

		//return view('Admin.users.index');	 
	}
	
	public function create(Request $request)
	{
			//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		$usertype 		= UserType::all();
		return view('Admin.users.create',compact(['usertype']));	
	}
	
	public function store(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										'first_name' => 'required|max:255',
										'last_name' => 'required|max:255',
										'email' => 'required|max:255|unique:admins',
										'password' => 'required|max:255',
										'phone' => 'required|max:255',
										'role' => 'required|max:255',
										'profile_img' => 'required|max:255'
									  ]);
			
			$requestData 		= 	$request->all();
			
			$obj				= 	new Admin;
			$obj->first_name	=	@$requestData['first_name'];
			$obj->last_name		=	@$requestData['last_name'];
			$obj->email			=	@$requestData['email'];
			$obj->password	=	Hash::make(@$requestData['password']);
			$obj->role	=	@$requestData['role'];
			$obj->phone	=	@$requestData['phone'];
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
			$obj->profile_img			=	@$profile_img;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/users')->with('success', 'User added Successfully');
			}				
		}	

		return view('Admin.users.create');	
	}
	
	public function edit(Request $request, $id = NULL)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		$usertype 		= UserType::all();
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			
			$this->validate($request, [										
										'first_name' => 'required|max:255',
										'last_name' => 'required|max:255',
							
										'email' => 'required|max:255|unique:admins,email,'.$requestData['id'],
										'phone' => 'required|max:255',
										'role' => 'required|max:255'
										
									  ]);
								  					  
			$obj							= 	Admin::find(@$requestData['id']);
						
			$obj->first_name				=	@$requestData['first_name'];
			$obj->last_name					=	@$requestData['last_name'];
			$obj->email						=	@$requestData['email'];
			if(!empty(@$requestData['password']))
				{		
					$obj->password				=	Hash::make(@$requestData['password']);
					//$objAdmin->decrypt_password		=	@$requestData['password'];
				}
			$obj->role						=	@$requestData['role'];
			$obj->phone						=	@$requestData['phone'];
			$obj->status						=	@$requestData['status'];
			
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
		/* Profile Image Upload Function End */
			$obj->profile_img			=	@$profile_img;
			$saved							=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			
			else
			{
				return Redirect::to('/admin/users')->with('success', 'User Edited Successfully');
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
					return view('Admin.users.edit', compact(['fetchedData', 'usertype']));
				}
				else
				{
					return Redirect::to('/admin/users')->with('error', 'User Not Exist');
				}	
			}
			else
			{
				return Redirect::to('/admin/users')->with('error', Config::get('constants.unauthorized'));
			}		
		}	
		
	}
	
	
	public function clientlist(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		$query 		= Admin::where('role', '=', '7');
		
		$totalData 	= $query->count();	//for all data

		$lists		= $query->sortable(['id' => 'desc'])->paginate(config('constants.limit'));
		
		return view('Admin.users.clientlist',compact(['lists', 'totalData']));	

		//return view('Admin.users.index');	  
	}
	public function createclient(Request $request) 
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		return view('Admin.users.createclient');	
	}
	
	public function storeclient(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										'company_name' => 'required|max:255',
										'first_name' => 'required|max:255',
										'last_name' => 'required|max:255',
										'company_website' => 'required|max:255',
										'email' => 'required|max:255|unique:admins',
										'password' => 'required|max:255',
										'phone' => 'required|max:255',
										'profile_img' => 'required|max:255'
									  ]);
			
			$requestData 		= 	$request->all();
			
			$obj				= 	new Admin;
			$obj->company_name	=	@$requestData['company_name'];
			$obj->first_name	=	@$requestData['first_name'];
			$obj->last_name		=	@$requestData['last_name'];
			$obj->company_website		=	@$requestData['company_website'];
			$obj->email			=	@$requestData['email'];
			$obj->password	=	Hash::make(@$requestData['password']);	
			$obj->phone	=	@$requestData['phone'];
			$obj->country	=	@$requestData['country'];
			$obj->city	=	@$requestData['city'];
			$obj->gst_no	=	@$requestData['gst_no']; 
			$obj->role	=	7;
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
			$obj->profile_img			=	@$profile_img;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/users/clientlist')->with('success', 'Client Added Successfully');
			}				
		}	

		return view('Admin.users.createclient');	
	}
	
	public function editclient(Request $request, $id = NULL)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('user_management', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		$usertype 		= UserType::all();
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			
			$this->validate($request, [	
										'company_name' => 'required|max:255',
										'first_name' => 'required|max:255',
										'last_name' => 'required|max:255',
										'company_website' => 'required|max:255',
										'email' => 'required|max:255|unique:admins,email,'.$requestData['id'],
										'password' => 'required|max:255',
										'phone' => 'required|max:255'
									  ]);
								  					  
			$obj							= 	Admin::find(@$requestData['id']);
			
			$obj->company_name	=	@$requestData['company_name']; 
			$obj->first_name	=	@$requestData['first_name'];
			$obj->last_name		=	@$requestData['last_name'];
			$obj->company_website		=	@$requestData['company_website'];
			$obj->email			=	@$requestData['email'];
			$obj->password	=	Hash::make(@$requestData['password']);				
						
			if(!empty(@$requestData['password']))
				{		
					$obj->password				=	Hash::make(@$requestData['password']);
					//$objAdmin->decrypt_password		=	@$requestData['password'];
				}
			$obj->phone	=	@$requestData['phone'];
			$obj->country	=	@$requestData['country'];
			$obj->city	=	@$requestData['city'];
			$obj->gst_no	=	@$requestData['gst_no']; 
			$obj->role	=	7;
			
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
		/* Profile Image Upload Function End */
			$obj->profile_img			=	@$profile_img;
			$saved							=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			
			else
			{
				return Redirect::to('/admin/users/clientlist')->with('success', 'Client Edited Successfully');
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
					return view('Admin.users.editclient', compact(['fetchedData', 'usertype']));
				}
				else
				{
					return Redirect::to('/admin/users/clientlist')->with('error', 'Client Not Exist');
				}	
			}
			else
			{
				return Redirect::to('/admin/users/clientlist')->with('error', Config::get('constants.unauthorized'));
			}		
		}	 
		 
	}
}
