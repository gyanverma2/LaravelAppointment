<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('health_professional_id');
            $table->date('date');
            $table->time('time');
            $table->string('time_zone'); // Time zone of the appointment
            $table->string('email');
            $table->string('location_type')->default('online'); // online or in-person
            $table->text('location_address')->nullable(); // Address for in-person appointments
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude for geolocation
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude for geolocation
            $table->string('virtual_meeting_link')->nullable(); // Link for online appointments
            $table->string('language', 10)->default('en'); // Preferred language for the appointment
            $table->string('contact_phone')->nullable(); // Phone number for communication
            $table->text('additional_notes')->nullable(); // Additional notes or instructions
            $table->string('status')->default('pending'); // Appointment status (pending, confirmed, completed, etc.)
            $table->string('confirmation_token')->nullable(); // Token for email confirmation
            $table->boolean('is_rescheduled')->default(false); // Flag for rescheduled appointments
            $table->text('cancellation_reason')->nullable(); // Reason for cancellation, if applicable
            $table->decimal('price', 8, 2)->nullable(); // Appointment price
            $table->string('currency', 3)->default('Euro'); // Currency of the price
            $table->string('payment_status')->default('unpaid'); // Payment status (unpaid, paid, etc.)
            $table->string('transaction_id')->nullable(); // Reference to payment transaction
            $table->unsignedBigInteger('created_by')->nullable(); // ID of the user who created the appointment
            $table->unsignedBigInteger('updated_by')->nullable(); // ID of the user who last updated the appointment
            $table->ipAddress('ip_address')->nullable(); // IP address of the user
            $table->string('device_info')->nullable(); // Device or browser information
            $table->unsignedBigInteger('recurring_id')->nullable(); // ID of the parent appointment for recurring bookings
            $table->boolean('follow_up_required')->default(false); // Indicates if a follow-up is required
            $table->date('follow_up_date')->nullable(); // Suggested date for follow-up
            $table->boolean('consent_provided')->default(false); // GDPR/CCPA compliance consent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
