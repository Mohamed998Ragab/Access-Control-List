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
        Schema::create('group_permission', function (Blueprint $table) {
            
            $table->foreignId('group_id')->constrained('groups','id')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permissions','id')->cascadeOnDelete();
            $table->primary(['group_id', 'permission_id']); // Composite primary key

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_permission');
    }
};
