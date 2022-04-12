<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Menu;

use Auth;
use Config;

class MenuController extends Controller
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
		
		$query 		= Menu::where('id', '!=', '');
		
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
		
		return view('Admin.menus.index',compact(['lists', 'totalData']));	
	} 
	
	public function create(Request $request)
	{
		
		return view('Admin.menus.create');	
	}
	
	public function store(Request $request)
	{
		
		if ($request->isMethod('post')) 
		{
			
			$this->validate($request, [
					'name' => 'required|max:255',
					'des' => 'required',
					
			]);
			$requestData 		= 	$request->all();
			$menu_hour = $requestData['menu_hour'];
			$start_time = $requestData['start_time'];
			$end_time = $requestData['end_time'];
			$menuarray = array();
			for($i = 0; $i<count($menu_hour); $i++){
				$menuarray[$i] = array(
					'weekdays' => $menu_hour[$i],
					'start_time' => $start_time[$i][0],
					'end_time' => $end_time[$i][0],
				); 
			}
		
			$obj				= 	new Menu;
			$obj->menu_name			=	@$requestData['name'];
			$obj->menu_description			=	@$requestData['des'];
			//$obj->user_id			=	Auth::user()->id;
			$obj->menu_hours			=	serialize($menuarray);
			$saved				=	$obj->save();  
			
			if(!$saved)
			{ 
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/menus/edit/'.base64_encode(convert_uuencode(@$obj->id)))->with('success', 'Menu added Successfully');
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
									  
			 $menu_hour = $requestData['menu_hour'];
			$start_time = $requestData['start_time'];
			$end_time = $requestData['end_time'];
			$menuarray = array();
			for($i = 0; $i<count($menu_hour); $i++){
				$menuarray[$i] = array(
					'weekdays' => $menu_hour[$i],
					'start_time' => $start_time[$i][0],
					'end_time' => $end_time[$i][0],
				); 
			}
			$obj				= 	Menu::find($requestData['id']);
			$obj->menu_name		=	@$requestData['name'];
			$obj->menu_hours			=	serialize($menuarray);
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/menus/edit/'.base64_encode(convert_uuencode($requestData['id'])))->with('success', 'Menu '.Config::get('constants.edited'));
			}				
		}
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Menu::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Menu::find($id);
					return view('Admin.menus.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/menus')->with('error', 'Menu '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/menus')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
