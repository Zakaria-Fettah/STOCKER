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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->text('adresse');
            $table->string('email');
            $table->string('telephone');
            $table->enum('genre', ['masculin', 'feminin']);
            $table->string('condition_payement');
            $table->date('date_livraison');
            $table->string('fiabilite');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
