<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use Translatable;
	public $translatedAttributes = ['name','description','short_description'];
	protected $fillable = ['type_id', 'event_date', 'status', 'name', 'locale'];
	
    public function eventtype()
    {
    	return $this->belongsTo('App\EventType','type_id','id');
    }

    public function eventImage()
    {
    	return $this->hasMany('App\EventImage');
    } 

    // public function notifications()
    // {
    //     return $this->morphMany('App\Notification', 'notificationable');
    // }

    public function user(){
        return $this->belongsTo('App\User');
    }
  
}
