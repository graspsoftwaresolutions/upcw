<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubMatchmaster extends Model
{
	protected $table = 'sub_match_master';
	protected $fillable = ['id','match_name','status'];
	public $timestamps = true;
}
