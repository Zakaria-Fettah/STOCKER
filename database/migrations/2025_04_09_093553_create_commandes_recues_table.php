<?php
// Exemple de migration pour commandes_recues
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesRecuesTable extends Migration
{
    public function up()
    {
        Schema::create('commande_recues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idFournisseur')->constrained('fournisseurs');
            $table->integer('quantite');
            $table->decimal('prix', 8, 2);
            $table->foreignId('idAchat')->constrained('achats');
            $table->date('dateCommande');
            $table->enum('statut', ['en_attente', 'en_cours', 'livrée', 'annulée']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_recues');
    }
}
