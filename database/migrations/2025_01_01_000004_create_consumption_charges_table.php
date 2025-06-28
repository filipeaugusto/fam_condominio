<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // 4. Lançamento de despesa proporcional por consumo
    public function up(): void {
        Schema::create('consumption_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('expense_id')->constrained()->cascadeOnDelete();
            $table->enum('service_class', ['water', 'light', 'cooking_gas', 'not_apply'])->default('not_apply');
            $table->integer('previous_reading')->default(0);
            $table->integer('current_reading');
            $table->integer('consumption');
            $table->decimal('unit_cost', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('consumption_charges');
    }
};
