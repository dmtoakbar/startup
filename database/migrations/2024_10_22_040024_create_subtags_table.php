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
        Schema::create('subtags', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('name');
            $table->string('tag_id');
            $table->foreign('tag_id')
            ->references('id')
            ->on('tags')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->String('status')->nullable()->default('Disapproved'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtags');
    }
};
