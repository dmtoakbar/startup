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
        Schema::create('questionpapers', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('questionpaperfronts_id');
            $table->string('subject')->nullable();
            $table->longText('direction')->nullable();
            $table->longText('question');
            $table->float('mark');
            $table->float('negative');
            $table->longText('a');
            $table->longText('b');
            $table->longText('c');
            $table->longText('d');
            $table->longText('e')->nullable();
            $table->string('answer');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionpapers');
    }
};
