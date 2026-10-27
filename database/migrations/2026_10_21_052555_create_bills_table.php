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
    Schema::create('bills', function (Blueprint $table) {
        $table->id();
        // Это наши FOREIGN KEYS. Если удалить клиента, у которого есть заказы — база запретит это (restrict)
        $table->foreignId('customer_id')->constrained()->onDelete('restrict');
        $table->foreignId('service_id')->constrained()->onDelete('restrict');
        $table->integer('units');
        $table->decimal('charged', 10, 2);
        $table->enum('status', ['queued', 'finished', 'departed'])->default('queued');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
