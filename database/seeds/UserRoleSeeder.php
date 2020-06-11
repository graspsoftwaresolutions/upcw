<?php

use Illuminate\Database\Seeder;
use DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
		INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
		(1, 1),
		");
    }
}
