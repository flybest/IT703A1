<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\App;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

//        $app=new App();
//        var_dump($app['config']);
//        var_dump($this->connection);

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('city');
            $table->string('post_code');
            $table->string('postal_address1');
            $table->string('postal_address2')->nullable();
            $table->string('postal_address3')->nullable();
            $table->string('postal_city');
            $table->string('postal_post_code');
        });

//        DB::statement("ALTER TABLE customers AUTO_INCREMENT = 2018;");
//        DB::statement("DELETE FROM sqlite_sequence WHERE name = 'customers';");
//        DB::statement("INSERT INTO main.sqlite_sequence (name, seq) VALUES ('customers', '100');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
