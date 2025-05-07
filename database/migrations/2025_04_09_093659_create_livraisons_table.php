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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->date('date'); // Date de la livraison
            $table->enum('statut', ['préparée', 'en_cours', 'livrée', 'retardée', 'annulée']); // Statut
            $table->integer('quantite'); // Quantité livrée
            $table->string('type'); // Type de livraison (ex : express, standard...)
    
            // Clés étrangères
            $table->foreignId('idClient')->constrained('clients')->onDelete('cascade');
            $table->foreignId('idCommande')->constrained('commandes_envoyees')->onDelete('cascade');
            $table->foreignId('idCategorie')->constrained('categories')->onDelete('cascade');
            $table->foreignId('idProduit')->constrained('produits')->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
