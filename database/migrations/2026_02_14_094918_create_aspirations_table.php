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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sender_id')->nullable()->constrained('users', 'id');
            $table->foreignId('staff_id')->nullable()->constrained('users', 'id');

            $table->string('title', 30);
            $table->string('location', 30);

            $table->text('content');
            $table->string('photo');

            $table->enum('status', ['accepted', 'process', 'finished', 'rejected']);

            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
