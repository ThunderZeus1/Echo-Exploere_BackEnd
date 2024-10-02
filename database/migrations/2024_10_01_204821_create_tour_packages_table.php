<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourism_company_id')->constrained()->onDelete('cascade');  // foreign key to tourism_companies
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('duration'); // duration in days
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
