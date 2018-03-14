<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookcopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_copies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('copy_number');
            $table->enum('type_of_copy', ['borrowable', 'referenced']);
            $table->integer('price');
            $table->enum('copy_status', ['available', 'referenced', 'borrowed', 'lent']);
            $table->text('integrity_status')->nullable();
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
        Schema::dropIfExists('book_copies');
    }
}
