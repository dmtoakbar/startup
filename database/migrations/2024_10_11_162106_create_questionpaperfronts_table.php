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
        Schema::create('questionpaperfronts', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('test_name');
            $table->string('name');
            $table->String('status')->nullable()->default('Disapproved');
            $table->string('sub_title');
            $table->float('duration');
            $table->float('total_question');
            $table->float('total_number');
            $table->string('minus_per_wrong_question');
            $table->longText('description')->nullable();
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionpaperfronts');
    }
};
