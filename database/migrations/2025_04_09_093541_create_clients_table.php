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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProduit')->constrained('produits'); 
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->text('adresse');
            $table->enum('type_client', ['particulier', 'entreprise']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
