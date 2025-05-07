<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CommandeEnvoyee;
use App\Models\EnvoiClient;
use Illuminate\Http\Request;

class EnvoiClientController extends Controller
{
    public function index()
    {
        $envois = EnvoiClient::with('client')->get();
        return view('envoi_clients.index', compact('envois'));
    }

    public function create()
    {
        $clients = Client::all();
        $commandes = CommandeEnvoyee::all();
        return view('envoi_clients.create', compact('clients', 'commandes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idClient' => 'required|exists:clients,id',
            'idCommandeEnvoyee' => 'required|exists:commande_envoyees,id',
        ]);

        EnvoiClient::create([
            'idClient' => $request->idClient,
            'idCommandeEnvoyee' => $request->idCommandeEnvoyee,
        ]);

        return redirect()->route('envoi_clients.index')->with('success', 'Envoi client créé avec succès.');
    }
}