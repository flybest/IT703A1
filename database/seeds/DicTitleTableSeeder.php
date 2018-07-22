<?php

use Illuminate\Database\Seeder;
use App\Title;

class DicTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $data=[[
        'id'=>0,
        'title'=>'No Title',
    ],[
        'id'=>2,
        'title'=>'Mr.',
    ],[
        'id'=>3,
        'title'=>'Mrs.',
    ],[
        'id'=>4,
        'title'=>'Ms.',
    ],[
        'id'=>5,
        'title'=>'Miss.',
    ],[
        'id'=>6,
        'title'=>'Dr.',
    ],[
        'id'=>7,
        'title'=>'Prof.',
    ]];


    public function run()
    {
        Title::truncate();

//        DB::table('dic_titles')->insert($this->data);

        Title::insert($this->data);
    }
}
