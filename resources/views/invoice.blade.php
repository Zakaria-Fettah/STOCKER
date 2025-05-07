<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .invoice-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .logo img {
            max-height: 80px;
            margin-bottom: 20px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .invoice-title {
            color: #3b7ddd;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3b7ddd;
        }
        table {
            margin-top: 20px;
            margin-bottom: 30px;
        }
        thead {
            background-color: #3b7ddd;
            color: white;
        }
        th {
            font-weight: 500;
        }
        .totals {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .totals p {
            margin-bottom: 5px;
            font-size: 1.05rem;
        }
        .totals strong {
            display: inline-block;
            width: 150px;
        }
        .text-primary {
            color: #3b7ddd !important;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        
   




        <div class="invoice-header">
            <div>
                <h2 class="fw-bold text-primary">STOCKER</h2>
                <p class="mb-0 text-muted">salmia 2 rue 18</p>
                <p class="mb-0 text-muted">Casablanca, Morocco</p>
                <p class="mb-0 text-muted">Tél: +212 773361220</p>
            </div>
           
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Client</h5>
                        <p class="mb-1"><strong>Nom :</strong> {{ $client_name }}</p>
                        <p class="mb-1"><strong>Adresse :</strong></p>
                        <p class="mb-0">{{ $client_address }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Facture</h5>
                        <p class="mb-1"><strong>Date :</strong> {{ $date }}</p>
                        <p class="mb-0"><strong>Méthode de paiement :</strong> Espèces</p>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-start">DÉSIGNATION</th>
                    <th class="text-center">QUANTITÉ</th>
                    <th class="text-end">PRIX UNITAIRE</th>
                    <th class="text-end">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="text-start">{{ $item['designation'] }}</td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    <td class="text-end">{{ number_format($item['price'], 2) }} DH</td>
                    <td class="text-end">{{ number_format($item['total'], 2) }} DH</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-end">
            <div class="col-md-5">
                <div class="totals">
                    <div class="d-flex justify-content-between">
                        <span><strong>Sous-total :</strong></span>
                        <span>{{ number_format($totalHT, 2) }} DH</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><strong>TVA (20%) :</strong></span>
                        <span>{{ number_format($tva, 2) }} DH</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2 pt-2 border-top">
                        <span><strong>Total TTC :</strong></span>
                        <span class="fw-bold">{{ number_format($totalTTC, 2) }} DH</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-3 border-top text-center text-muted">
            <p class="mb-1">Merci pour votre confiance !</p>
            <p class="mb-0">Conditions de paiement : Paiement à réception de facture</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>