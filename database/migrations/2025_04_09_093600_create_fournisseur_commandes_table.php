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
        Schema::create('fournisseur_commandes', function (Blueprint $table) {
            $table->id(); // Clé primaire de la table
            $table->foreignId('idCommande')->constrained('commandes_recues'); // Relation avec la table commandes_recues
            $table->foreignId('idFournisseur')->constrained('fournisseurs'); // Relation avec la table fournisseurs
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseur_commandes');
    }
};
