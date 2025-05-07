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
        Schema::create('envoi_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idClient');
            $table->unsignedBigInteger('idCommandeEnvoyee');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envoi_clients');
    }
};
