<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Url extends Model
{
	use SoftDeletes;

    protected $table = 'urls';
    protected $primaryKey = 'url_id';
    protected $guarded = [];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function setActualUrlAttribute($value)
    {
    	$this->attributes['actual_url'] = str_slug($value);
    }

}
