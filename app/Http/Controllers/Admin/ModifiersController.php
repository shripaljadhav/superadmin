<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Modifiers;

use Auth;
use Config;

class ModifiersController extends Controller
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
		$query 		= Modifiers::where('id', '!=', '');
		
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
		
		$lists		= $query->orderby('name','ASC')->paginate(20);
		
		return view('Admin.modifiers.index',compact(['lists', 'totalData']));	
	} 
	
	public function create(Request $request)
	{
		return view('Admin.modifiers.create');	
	}
	
	public function store(Request $request)
	{
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
					'name' => 'required|max:255',
			]);
			$requestData 		= 	$request->all();
					
			$itemid = $requestData['itemid'];
			$price = $requestData['price'];
			$items = array();
			for($i=0; $i<count($itemid); $i++){
				$items[] = array(
					'item' =>$itemid[$i],
					'price' =>$price[$i],
				);
			}
			$obj				= 	new Modifiers;
			$obj->name			=	@$requestData['name'];
			$obj->items			=	serialize($items);
			//$obj->default_quantities		=	@$requestData['status'];
			$obj->minPermittedTotal		=	@$requestData['minPermittedTotal'];
			$obj->maxPermittedTotal		=	@$requestData['maxPermittedTotal'];
			$obj->maxPermittedPerOption		=	@$requestData['maxPermittedPerOption'];
		//	$obj->restaurant_id		=	Auth::user()->id;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/modifiers')->with('success', 'Modifier added Successfully');
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
					'name' => 'required|max:255',
										
									  ]);
			$itemid = $requestData['itemid'];
			$price = $requestData['price'];
			$items = array();
			for($i=0; $i<count($itemid); $i++){
				$items[] = array(
					'item' =>$itemid[$i],
					'price' =>$price[$i],
				);
			}
			$obj				= 	Modifiers::find(@$requestData['id']);
			$obj->name			=	@$requestData['name'];
			$obj->items			=	serialize($items);
			//$obj->default_quantities		=	@$requestData['status'];
			$obj->minPermittedTotal		=	@$requestData['minPermittedTotal'];
			$obj->maxPermittedTotal		=	@$requestData['maxPermittedTotal'];
			$obj->maxPermittedPerOption		=	@$requestData['maxPermittedPerOption'];
			//$obj->restaurant_id		=	Auth::user()->id;
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/modifiers')->with('success', 'Modifier '.Config::get('constants.edited'));
			}				
		}
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Modifiers::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Modifiers::find($id);
					return view('Admin.modifiers.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/modifiers')->with('error', 'Modifier '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/modifiers')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
