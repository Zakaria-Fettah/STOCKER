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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // Clé primaire de la table
            $table->foreignId('idProduit')->constrained('produits'); // Relation avec la table produits
            $table->foreignId('idCategorie')->constrained('categories'); // Relation avec la table categories
            $table->integer('quantite'); // Quantité du stock
            $table->text('description')->nullable(); // Colonne description, type texte, nullable
            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};