<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price');
            $table->timestamps();
        });
        DB::table('shippings')->insert([
            'name' => 'Osobne',
            'price' => 0
        ]);
        DB::table('shippings')->insert([
            'name' => 'Kurier',
            'price' => 5.99
        ]);
        DB::table('shippings')->insert([
            'name' => 'Posta',
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
        Schema::dropIfExists('shippings');
    }
}
