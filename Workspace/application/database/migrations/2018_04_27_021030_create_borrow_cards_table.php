<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number')->unique();
            $table->integer('user_id');
            $table->string('activation_code')->unique();
            $table->boolean('is_activated');
            $table->dateTime('expired_date');
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
        Schema::dropIfExists('borrow_cards');
    }
}
