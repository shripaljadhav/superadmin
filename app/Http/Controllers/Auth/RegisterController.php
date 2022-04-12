<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Config;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		if(!empty($data['phone_register']))
		{	
			$data['phone_register'] = str_replace("-","", @$data['phone_register']);
		}
		
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email_register' => 'required|string|email|max:191|unique:users,email',
            'password_register' => 'required|string|min:6|max:12',
            'phone_register' => 'required|string|min:10|unique:users,phone',
            'course_level' => 'nullable|max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required|string|max:255',
			'address' => 'required',
            'zip' => 'required|string|max:40'
        ], [
				'email_register.required' => 'The email field is required.',
				'email_register.email' => 'The email must be a valid email address.',
				'password_register.required' => 'The password field is required.',
				'password_register.min' => 'The password must be at least 6 characters.',
				'password_register.max' => 'The password may not be greater than 10 characters.',
				'phone_register.required' => 'The phone field is required.',
				'phone_register.min' => 'The phone must be at least 12 characters.',
			]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $result = User::create([
            'first_name' 	=> @$data['first_name'],
            'last_name' 	=> @$data['last_name'],
            'email' 		=> @$data['email_register'],
            'password' 		=> Hash::make($data['password_register']),
            'phone' 		=> str_replace("-","", @$data['phone_register']),
            'course_level' 	=> @$data['course_level'],
            'country' 		=> @$data['country'],
            'state' 		=> @$data['state'],
            'city' 			=> @$data['city'],
            'address' 		=> @$data['address'],
            'zip' 			=> @$data['zip']
        ]);
		
		if($result)
		{
			$replace = array('{logo}', '{first_name}', '{last_name}', '{year}');					
			$replace_with = array(\URL::to('/').Config::get('constants.logoImg'), @$data['first_name'], @$data['last_name'], date('Y'));
			
			$this->send_email_template($replace, $replace_with, 'signup', @$data['email_register']);
			
			return $result;
		}
    }
}
