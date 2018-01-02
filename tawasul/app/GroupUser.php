<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
	use Translatable;
	public $translatedAttributes = ['group_name','group_description'];
	protected $fillable = ['group_type_id','group_user_id', 'group_name', 'locale'];
	

}
