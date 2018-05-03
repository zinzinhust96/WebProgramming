<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrow_record_id');
            $table->integer('borrow_card_id');
            $table->string('status_before');
            $table->string('status_after')->nullable();
            $table->dateTime('lent_date');
            $table->dateTime('expired_date');
            $table->dateTime('returned_date')->nullable();
            $table->string('pre_paid')->nullable();
            $table->string('borrow_fee')->nullable();
            $table->string('compensation_fee')->nullable();
            $table->string('total_paid')->nullable();
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
        Schema::dropIfExists('borrow_informations');
    }
}
