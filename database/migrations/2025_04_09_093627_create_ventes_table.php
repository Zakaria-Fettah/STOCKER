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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id(); // ID de la vente
    
            // Clés étrangères
            $table->foreignId('idProduit')->constrained('produits')->onDelete('cascade');
            $table->foreignId('idClient')->constrained('clients')->onDelete('cascade');
            $table->foreignId('idStock')->constrained('stock')->onDelete('cascade');
    
            // Données de la vente
            $table->integer('quantiteVendue');
            $table->decimal('prixUnitaire', 10, 2);
            $table->decimal('total', 12, 2);
            $table->decimal('benifice', 12, 2)->default(0);
    
            $table->timestamps(); // created_at et updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
