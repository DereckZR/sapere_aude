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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 16, 2);
            $table->decimal('author_comission_percentage', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('member_id')->constrained()->restrictOnDelete();
            $table->decimal('author_percentage', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['in', 'out']);
            $table->integer('quantity');
            $table->string('reason');
            $table->text('reason_details')->nullable();
            $table->date('movement_date');
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
        Schema::dropIfExists('product_authors');
        Schema::dropIfExists('products');
    }
};
