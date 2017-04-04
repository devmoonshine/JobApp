<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
	protected $fillable = ['email', 'file'];

    public function users()
    {
    	return $this->hasOne(User::class);
    }

    public function getRouteKeyName()
    {
    	return 'file';
    }
}
