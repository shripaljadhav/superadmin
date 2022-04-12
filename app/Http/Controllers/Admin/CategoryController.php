<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Category;

use Auth;
use Config;

class CategoryController extends Controller
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
		$query 		= Category::where('id', '!=', '')->with(['restaurantdata']);
		
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
		
		return view('Admin.categories.index',compact(['lists', 'totalData']));	
	} 
	
	public function create(Request $request)
	{
		return view('Admin.categories.create');	
	}
	
	public function store(Request $request)
	{
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
					'title' => 'required|max:255',
					'restaurant' => 'required|max:255',
			]);
			$requestData 		= 	$request->all();
			if($request->hasfile('image')) 
			{	
				$topinclu_image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage')); 
			}
			else
			{ 
				$topinclu_image = NULL;
			}
			
			$obj				= 	new Category;
			$obj->name			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$obj->restaurant_id		=	@$requestData['restaurant'];
			$obj->image		=	@$topinclu_image;
			$obj->slug	=	$this->createlocSlug('categories',@$requestData['title'],@$requestData['restaurant']);
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/categories')->with('success', 'Category added Successfully');
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
			if($request->hasfile('image')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['image'] != '')
						{
							$this->unlinkFile($requestData['old_image'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$topinclu_image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
			}
			else
			{
				$topinclu_image = @$requestData['old_image'];
			}
			$obj				= 	Category::find(@$requestData['id']);
			$obj->name			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$obj->restaurant_id		=	@$requestData['restaurant'];
			$obj->image		=	@$topinclu_image;
			$obj->slug	=	$this->createlocSlug('categories',@$requestData['title'],@$requestData['restaurant'], $requestData['id']);
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/categories')->with('success', 'Category '.Config::get('constants.edited'));
			}				
		}
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Category::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Category::find($id);
					return view('Admin.categories.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/categories')->with('error', 'Category '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/categories')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
