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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('career');
            $table->string('phone_number', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->foreignId('admission_cycle_id')->constrained('cycles')->restrictOnDelete();
            $table->foreignId('last_active_cycle_id')->nullable()->constrained('cycles')->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('member_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->restrictOnDelete();
            $table->foreignId('cycle_id')->constrained()->restrictOnDelete();
            $table->date('contribution_date')->nullable();
            $table->decimal('contribution_amount', 16, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_contributions');
        Schema::dropIfExists('members');
    }
};
