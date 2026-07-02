<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->text('suffix')->nullable();
            $table->text('gender')->nullable();
            $table->string('account_number')->nullable();
            $table->string('membership_id')->nullable();
            $table->string('membership_no')->nullable();
            $table->text('municipality')->nullable();
            $table->text('barangay')->nullable();
            $table->text('street')->nullable();
            $table->text('membership_type')->nullable();
            $table->string('registration_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
