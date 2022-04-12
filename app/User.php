<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	use Sortable;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	
	/*protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'phone', 'course_level', 'country', 'state', 'city', 'address', 'zip', 'profile_img', 'provider', 'provider_id', 'first_time_msg', 'status', 'created_at', 'updated_at'
    ];*/
	 
	protected $fillable = [
        'id', 'company_name', 'first_name', 'last_name', 'company_website', 'email', 'password', 'utype', 'phone', 'profile_img', 'country', 'city', 'gst_no', 'status', 'created_at', 'updated_at'
    ];

    /** 
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */ 
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function countryData()
    {
        return $this->belongsTo('App\Country','country');
    }
	
	public function stateData()
    {
        return $this->belongsTo('App\State','state');
    }
	
}
