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
            $table->string('title')->nullable(FALSE)->default('');
            $table->text('description');
            $table->string('slug')->nullable(FALSE)->default('');
            $table->double('price')->nullable(FALSE)->default(0);
            $table->integer('quantity', FALSE, TRUE)->nullable(FALSE)->default(0);
            $table->tinyInteger('status')->nullable(FALSE)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
