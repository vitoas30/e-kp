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
        Schema::rename('sub_menus', 'permissions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('permissions', 'sub_menus');
    }
};
