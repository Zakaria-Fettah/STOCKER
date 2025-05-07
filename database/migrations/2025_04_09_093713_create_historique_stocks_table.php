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
        Schema::create('historique_stocks', function (Blueprint $table) {
            $table->id();
    
            // Relations
            $table->foreignId('idClient')->constrained('clients')->onDelete('cascade');
            $table->foreignId('idFournisseur')->constrained('fournisseurs')->onDelete('cascade');
            $table->foreignId('idProduit')->constrained('produits')->onDelete('cascade');
            $table->foreignId('idCategorie')->constrained('categories')->onDelete('cascade');
            $table->foreignId('idCommande')->constrained('commandes_envoyees')->onDelete('cascade');
            $table->foreignId('idLivraison')->constrained('livraisons')->onDelete('cascade');
            $table->foreignId('idAchat')->constrained('achats')->onDelete('cascade');
            $table->foreignId('idStock')->constrained('stock')->onDelete('cascade');
    
            // Champ bénéfice
            $table->decimal('benifice', 10, 2)->default(0); // avec 2 décimales
    
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_stocks');
    }
};
