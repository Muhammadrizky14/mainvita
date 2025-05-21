<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYogaBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoga_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->unsignedBigInteger('yoga_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->date('booking_date');
            $table->string('booking_time');
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('payment_token')->nullable();
            $table->text('payment_details')->nullable();
            $table->timestamps();
            
            $table->foreign('yoga_id')->references('id')->on('yogas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yoga_bookings');
    }
}