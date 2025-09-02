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
        Schema::create('digestcontents', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('title');
            $table->longText('content');
            $table->string('feature_img')->nullable();
            $table->string('tag_id');
            $table->foreign('tag_id')
            ->references('id')
            ->on('tags')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('subtag_id')->nullable();
            $table->foreign('subtag_id')
            ->references('id')
            ->on('subtags')
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
        Schema::dropIfExists('digestcontents');
    }
};
