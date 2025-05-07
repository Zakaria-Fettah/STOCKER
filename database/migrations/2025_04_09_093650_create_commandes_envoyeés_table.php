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
        Schema::create('commandes_envoyees', function (Blueprint $table) {
            $table->id(); // Clé primaire de la table
            $table->unsignedBigInteger('client_id'); // Ajouter la colonne client_id
            $table->date('dateCommande'); // La date de la commande envoyée
            $table->enum('statut', ['en_attente', 'envoyée', 'annulée', 'livrée']); // Statut de la commande envoyée
            $table->timestamps(); // Pour les colonnes created_at et updated_at

            // Ajouter la contrainte de clé étrangère
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes_envoyees');
    }
};
