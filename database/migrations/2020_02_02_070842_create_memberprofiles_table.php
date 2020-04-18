<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->text('member_name')->nullable();
			$table->text('ic_no_new')->nullable();
			$table->integer('race')->nullable();
			$table->string('sex', 100)->nullable();
			$table->date('dob')->nullable();
			$table->date('doj')->nullable();
			$table->text('address')->nullable();
			$table->text('postal_code')->nullable();
			$table->integer('company_name')->nullable();
			$table->text('position')->nullable();
			$table->text('member_no')->nullable();
			$table->text('employee_no')->nullable();
			$table->text('telephone_no')->nullable();
			$table->text('telephone_no_office')->nullable();
			$table->text('telephone_no_hp')->nullable();
			$table->text('email_id')->nullable();
			$table->text('entrance_fee')->nullable();
			$table->text('monthly_fee')->nullable();
			$table->text('recommended_by')->nullable();
			$table->text('supported_by')->nullable();
			$table->tinyInteger('member_status')->default('1');
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberprofiles');
    }
}
