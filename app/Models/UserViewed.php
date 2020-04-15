<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserViewed extends Model
{
    /**
     * The database table used by the model.
     *
     * @access protected
     * @var string
     */
	 
	protected $table = 'user_viewed';
	       
	 /**
     * The attributes that are mass assignable.
     *
     * @access protected
     * @var array
     */
	 
	protected $fillable = ['id','user_id','event_id','created_at','updated_at'];
}
