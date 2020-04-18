<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class subcompany extends Model
{
	protected $table = 'subcompany';
	protected $fillable = ['id','statusMonth_id','company_id'];
	public $timestamps = true;
}
