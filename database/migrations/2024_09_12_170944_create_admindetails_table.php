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
        Schema::create('admindetails', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('alternate_mobile_number')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('department')->nullable();
            $table->string('user_type')->nullable()->default('Admin User');
            $table->string('user_status')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_time')->nullable();
            $table->timestamp('last_log_out_time')->nullable();
            $table->string('email_verify_token_id');
            $table->string('email_verify_token_key');
            $table->integer('email_verify_expiry_time');
            $table->string('password_forget_token_id')->nullable();
            $table->string('password_forget_token_key')->nullable();
            $table->integer('password_forget_expiry_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admindetails');
    }
};
