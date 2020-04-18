<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';
	protected $fillable = ['id','name','status'];
	public $timestamps = true;
}
