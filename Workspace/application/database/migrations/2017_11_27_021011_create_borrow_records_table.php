<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_copy_id');
            $table->integer('user_id');
            $table->enum('status', ['registered', 'accepted', 'rejected', 'lent', 'returned']);
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
        Schema::dropIfExists('borrow_records');
    }
}
