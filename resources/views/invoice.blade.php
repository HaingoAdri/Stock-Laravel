<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        @page {
            size: A5;
            margin: 10mm;
        }

        .invoice-container {
            width: 100%;
            max-width: 100%;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            box-sizing: border-box;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-header .logo {
            text-align: right;
        }

        .invoice-header .details {
            flex-shrink: 0;
            margin-top: -10%;
        }

        .invoice-header img {
            max-width: 150px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .invoice-header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .invoice-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-body table, th, td {
            border: 1px solid #ddd;
        }

        .invoice-body th, .invoice-body td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .invoice-body th {
            background-color: #f9f9f9;
        }

        .invoice-body tfoot {
            font-weight: bold;
            font-size: 14px;
        }

        .invoice-footer {
            border-top: 2px solid #eee;
            padding-top: 10px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <header class="invoice-header">
            <div class="logo">
                <h1>FEEL IN BOX</h1>
            </div>
            <div class="details">
                <h1>Facture</h1>
                <p><strong>Numéro de Référence :</strong> {{ $invoice_number }}</p>
                <p><strong>Date :</strong> {{ $date }}</p>
            </div>
        </header>
        <section class="invoice-body">
            <table>
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['unit_price'] }}</td>
                            <td>{{ $item['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total à Payer :</strong></td>
                        <td><strong>{{ $total_to_pay }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Montant Donné :</strong></td>
                        <td><strong>{{ $amount_given }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Reste :</strong></td>
                        <td><strong>{{ $amount_due }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <footer class="invoice-footer">
            <p>Merci pour votre achat !</p>
        </footer>
    </div>
</body>
</html>
