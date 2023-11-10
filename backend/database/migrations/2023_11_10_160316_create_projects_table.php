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
        Schema::create('Projects', function (Blueprint $table) {  // Update the table name to 'Projects'
            $table->id();
            $table->integer('PlaylistId');
            $table->string('Season');
            $table->string('ProjectNote');
            $table->date('ProjectDateIni');
            $table->date('ProjectDateEnd');
            $table->string('ProjectRevision');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Projects');  // Update the table name to 'Projects'
    }
};
