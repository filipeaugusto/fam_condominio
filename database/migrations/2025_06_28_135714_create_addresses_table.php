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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('addressable_type', 255);
            $table->bigInteger('addressable_id');
            $table->string('zip_code');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('Brasil');
            $table->unique(['addressable_type', 'addressable_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
