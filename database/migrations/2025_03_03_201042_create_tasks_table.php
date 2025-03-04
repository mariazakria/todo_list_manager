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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            
            // Basic task information
            $table->string('title')->nullable(false); //mynf3sh yb2a fady
            $table->text('description')->nullable(); 
            
            // Status tracking
            $table->enum('status', ['pending', 'in_progress', 'completed'])
                  ->default('pending'); //status :default pending
            
            // Priority levels
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])
                  ->default('medium'); //elahmia 
            
            // Dates
            $table->date('due_date')->nullable(); //most7ka
            $table->timestamp('completed_at')->nullable(); //5lst emta
            
            // User relationships
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            // Timestamps
            $table->timestamps();             
            $table->softDeletes(); //etms7t amta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};