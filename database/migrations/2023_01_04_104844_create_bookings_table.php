<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('day')->nullable();
            $table->string('branch')->nullable();
            $table->string('stime')->nullable();
            $table->string('etime')->nullable();
            $table->enum('work_status',['1','0'])->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
