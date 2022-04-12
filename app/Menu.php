<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Menu extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'menu_name', 'menu_description','created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'menu_name', 'menu_description', 'created_at', 'updated_at'];
}