<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_member', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('subcompany_id')->nullable();
			$table->integer('member_code')->nullable();
			$table->string('company_name', 250)->nullable();
			$table->string('member_name', 250)->nullable();
			$table->string('member_no', 250)->nullable();
			$table->string('member_ic', 250)->nullable();
			$table->float('subs', 14, 2)->nullable();
			$table->float('insur', 14, 2)->nullable();
			$table->tinyInteger('status')->default('1');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_member');
    }
}
