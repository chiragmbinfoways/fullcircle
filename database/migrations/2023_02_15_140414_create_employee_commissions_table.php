<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('appointment_id')->unsigned()->nullable();
            $table->foreign('appointment_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->string('emp_id')->nullable();
            $table->string('commission')->nullable();
            $table->enum('payment_status',['0','1'])->default('0')->nullable();
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
        Schema::dropIfExists('employee_commissions');
    }
}
