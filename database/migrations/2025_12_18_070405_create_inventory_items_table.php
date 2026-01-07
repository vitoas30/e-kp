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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->unsignedBigInteger('category_item_id')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('condition')->default('Good'); 
            $table->date('purchase_date')->nullable();
            $table->timestamps();
            
             $table->foreign('category_item_id')->references('id')->on('category_items')->onDelete('set null');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
