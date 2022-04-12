<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Country;

use Auth;
use Config;

class CountryController extends Controller
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
		  
		 $query 		= Country::where('id', '!=', '');
		
		$totalData 	= $query->count();	//for all data
		
		if ($request->has('search_term')) 
		{
			$search_term 		= 	$request->input('search_term');
			if(trim($search_term) != '')
			{		
				$query->where('name', 'LIKE', '%' . $search_term . '%');
			}
		}
		
		if ($request->has('search_term') || $request->has('search_term_from') || $request->has('search_term_to')) 
		{
			$totalData 	= $query->count();//after search
		}
		
		$lists		= $query->orderby('id','DESC')->paginate(20); 
		
		return view('Admin.country.index',compact(['lists', 'totalData']));	
	} 
	 
	public function create(Request $request)
	{ 
	
		return view('Admin.country.create');	 
	}
	
	public function store(Request $request)
	{
		 	
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										'name' => 'required|max:255'
									  ]);
			
			$requestData 		= 	$request->all();
			
			$obj				= 	new Country;
			$obj->name	=	@$requestData['name'];
			$obj->status	=	@$requestData['status'];
			
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else 
			{
				return Redirect::to('/country')->with('success', 'Country added Successfully');
			}				
		}			 
	} 
	
	public function edit(Request $request, $id = NULL)
	{	
	 	
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			$this->validate($request, [
										'name' => 'required|max:255'
									  ]);
			
			$obj				= 	 Country::find($requestData['id']);
			$obj->name	=	@$requestData['name'];
			$obj->status	=	@$requestData['status'];
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/country')->with('success', 'Country added Successfully');
			}				
		}	
		else 
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Country::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Country::find($id);
					return view('Admin.country.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/country')->with('error', 'Country '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/country')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
