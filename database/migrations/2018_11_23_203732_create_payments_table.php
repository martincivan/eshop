<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price');
            $table->timestamps();
        });
        DB::table('payments')->insert([
            'name' => 'Hotovost',
            'price' => 1.99
        ]);
        DB::table('payments')->insert([
            'name' => 'Online',
            'price' => 5.99
        ]);
        DB::table('payments')->insert([
            'name' => 'Prevod',
            'price' => 2.99
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
