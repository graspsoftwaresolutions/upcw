<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Memberprofile extends Model
{
	protected $table = 'memberprofiles';
	protected $fillable = ['id','member_name','ic_no_new','race','sex','dob','doj','address','postal_code','company_name','position','member_no','employee_no','telephone_no','telephone_no_office','telephone_no_hp','email_id','entrance_fee','monthly_fee','recommended_by','supported_by','member_status','resign_date'];
	public $timestamps = true;
}
