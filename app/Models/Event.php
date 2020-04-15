<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @access protected
     * @var string
     */
	 
	protected $table = 'events';
	       
	 /**
     * The attributes that are mass assignable.
     *
     * @access protected
     * @var array
     */
	 
	protected $fillable = ['id','event_name','event_description','event_fname','event_status','event_scheduled_date','event_scheduled','created_at','updated_at'];
}
