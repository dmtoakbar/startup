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
        Schema::create('studentusers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('mobile_number')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('user_status')->nullable()->default('Approved');
            $table->integer('otp')->nullable();
            $table->enum('is_otp_verified', ['0', '1'])->nullable()->default(0);
            $table->integer('otp_expiry')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentusers');
    }
};
