<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_id');
            $table->string('customerPack_id')->nullable();
            $table->string('Appointment_date')->nullable();
            $table->string('time')->nullable();
            $table->string('Trainer')->nullable();
            $table->enum('visited',['1','0'])->default('0');
            $table->enum('appointment_taken',['1','0'])->default('0');
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
        Schema::dropIfExists('customer_appointments');
    }
}
