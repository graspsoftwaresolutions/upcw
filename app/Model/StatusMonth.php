<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusMonth extends Model
{
	protected $table = 'statusmonth';
	protected $fillable = ['id','statusMonth'];
	public $timestamps = true;
}
