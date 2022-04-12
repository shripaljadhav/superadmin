<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Cuisine;

use Auth;
use Config;

class CuisineController extends Controller
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
		
		$query 		= Cuisine::where('id', '!=', '');
		
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
		
		return view('Admin.cuisine.index',compact(['lists', 'totalData']));	
	} 
	
	public function create(Request $request)
	{
		
		return view('Admin.cuisine.create');	
	}
	
	public function store(Request $request)
	{
		
		if ($request->isMethod('post')) 
		{
			
			$this->validate($request, [
					'title' => 'required|max:255',
					
			]);
			$requestData 		= 	$request->all();
			
			
			$obj				= 	new Cuisine;
			$obj->title			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/cuisine')->with('success', 'Cuisine added Successfully');
			}
		}			
	}
	
	public function edit(Request $request, $id = NULL)
	{	
		
	
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all(); 
			//echo $requestData['id']; die;
			$this->validate($request, [
					'title' => 'required|max:255',
										
									  ]);
									  
			
			$obj				= 	Cuisine::find(@$requestData['id']);
			$obj->title			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
		
			//$obj->slug	=	$this->createlocSlug('leas',@$requestData['title'], $requestData['id']);
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/cuisine')->with('success', 'Cuisine '.Config::get('constants.edited'));
			}				
		}
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Cuisine::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Cuisine::find($id);
					return view('Admin.cuisine.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/cuisine')->with('error', 'Cuisine '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/cuisine')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
