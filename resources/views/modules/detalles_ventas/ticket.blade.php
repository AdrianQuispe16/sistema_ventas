<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Compra</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .ticket {
            width: 320px; 
            margin: auto;
            padding: 20px;
            border: 2px dashed #555;
            border-radius: 10px;
            background: #fafafa;
        }

        h2 {
            text-align: center;
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        hr {
            border: none;
            border-top: 1px solid #999;
            margin: 10px 0;
        }

        .info p {
            margin: 4px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th {
            background: #eee;
            padding: 5px;
            font-size: 12px;
            border: 1px solid #ccc;
        }

        td {
            padding: 6px 4px;
            font-size: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .total-final {
            text-align: right;
            margin-top: 12px;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            border-top: 1px dashed #666;
            padding-top: 8px;
        }
    </style>
</head>

<body>
<div class="ticket">

    <h2>Ticket de Compra</h2>
    <hr>

    <div class="info">
        <p><strong>Usuario:</strong> {{ $venta->nombre_usuario }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at }}</p>
        <p><strong>Total:</strong> S/ {{ number_format($venta->total_venta, 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>P. Unit.</th>
                <th>Sub.</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($detalles as $item)
            <tr>
                <td>{{ $item->nombre_producto }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>S/ {{ number_format($item->precio_unitario, 2) }}</td>
                <td>S/ {{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total-final">
        TOTAL: S/ {{ number_format($venta->total_venta, 2) }}
    </p>

    <div class="footer">
        ¡Gracias por su compra!
    </div>

</div>
</body>
</html>
