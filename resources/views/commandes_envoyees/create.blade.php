@extends('layout.mainlayout')

@section('content')
    <style>
        .form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f4f8;
            padding: 20px;
        }
        .form-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: box-shadow 0.3s ease;
            max-width: 500px;
            width: 100%;
        }
        .form-card:hover {
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        .card-header {
            background: #007bff;
            color: #ffffff;
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
        }
        .card-body {
            padding: 30px;
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #d2d6dc;
            padding: 10px 15px;
            font-size: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
            outline: none;
        }
        .btn-primary {
            border-radius: 6px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #007bff;
            border: none;
            transition: background 0.3s ease, transform 0.2s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .error-message {
            font-size: 0.85rem;
            color: #e3342f;
            margin-top: 5px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        @media (max-width: 576px) {
            .form-card {
                margin: 0 15px;
            }
            .card-body {
                padding: 20px;
            }
        }
    </style>

    <div class="form-container">
        <div class="form-card">
            <div class="card-header">
                Nouvelle Commande
            </div>
            <div class="card-body">
                <h1 class="form-title">Ajouter une commande envoyée</h1>
                <form action="{{ route('commandes_envoyees.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="dateCommande" class="form-label">Date de commande</label>
                        <input type="date" class="form-control" id="dateCommande" name="dateCommande" required>
                        @error('dateCommande')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="client_id" class="form-label">Client</label>
                        <select class="form-select" id="client_id" name="client_id" required>
                            <option value="" disabled selected>Choisir un client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-select" id="statut" name="statut">
                            <option value="en_attente">En attente</option>
                            <option value="envoyée">Envoyée</option>
                            <option value="annulée">Annulée</option>
                            <option value="livrée">Livrée</option>
                        </select>
                        @error('statut')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
