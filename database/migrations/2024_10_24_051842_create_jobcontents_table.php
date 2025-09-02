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
        Schema::create('jobcontents', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('title');
            $table->text('description');
            $table->text('organisation_intro');
            $table->text('important_dates');
            $table->text('fee_structure');
            $table->text('basic_qualifaction');
            $table->longText('detail_first');
            $table->longText('detail_second')->nullable();
            $table->longText('detail_third')->nullable();
            $table->jsonb('important_links');
            $table->string('jobtag_id');
            $table->foreign('jobtag_id')
            ->references('id')
            ->on('jobtags')
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
        Schema::dropIfExists('jobcontents');
    }
};
