<?php

use Illuminate\Database\Seeder;
use App\AdminAccount;

class AdminAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create the default admin user
        AdminAccount::truncate();

        AdminAccount::create([
            'user_name' => 'admin',
            'admin_type' => 'super',
            'password' => bcrypt('123456'),
        ]);
    }
}
