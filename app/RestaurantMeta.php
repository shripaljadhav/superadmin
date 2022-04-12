<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RestaurantMeta extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'user_id', 'meta_key', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'user_id', 'created_at', 'updated_at'];
	
}