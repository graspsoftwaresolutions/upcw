<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMember extends Model
{
	protected $table = 'subscription_member';
	protected $fillable = ['id','subcompany_id','member_code','company_name','member_name','member_no','member_ic','subs','insur','match_no'];
	public $timestamps = true;
}
