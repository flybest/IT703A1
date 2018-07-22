<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(AdminAccountTableSeeder::class);
        $this->call(DicTitleTableSeeder::class);


        factory(App\AdminAccount::class,30)->create();
        factory(App\Customer::class,30)->create();
        factory(App\Contact::class,40)->create();
    }
}
