<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    // 3. Despesas fixas e rateios manuais

    public function up(): void {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condominium_id')->constrained('condominiums')->cascadeOnDelete();
            $table->enum('type', ['fixed', 'variable', 'reserve', 'emergency'])->default('fixed');
            $table->enum('service_class', ['water', 'light', 'cooking_gas', 'not_apply'])->default('not_apply');
            $table->string('label');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->boolean('included_in_closing')->default(false);
            $table->foreignId('monthly_closing_id')->nullable()->constrained('monthly_closings')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('expenses');
    }
};
