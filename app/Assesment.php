<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Assesment extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'title', 'description', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
	
	public function couseiddata() 
    {
        return $this->belongsTo('App\Course','course_id','id');
    }
	public function learningdata() 
    {
        return $this->belongsTo('App\Learning','step_id','id');
    }
	public function lessondata() 
    {
        return $this->belongsTo('App\Lesson','lesson_id','id');
    }
}