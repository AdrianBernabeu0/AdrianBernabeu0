<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagament simulat</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .contenedorCorreoPDF {
            width: 100%;
            height: 100vh;
        }

        .contenedorCheckCorreoPDf {
            margin-bottom: 20px;
        }

        .textConfirmacio {
            font-size: 14px;
            margin-top: 10px;
            font-weight: bold;
        }

        .contenedorDetallCorreoPDF {
            background-color: #f3f3f3;
            border-radius: 10px;
            padding: 15px;
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        th {
            text-align: left;
            font-weight: bold;
        }

        td {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="contenedorCorreoPDF">
        <div class="contenedorCheckCorreoPDf">
            <img src="{{ public_path('img/checkReserva.png') }}" alt="check" width="80">
            <p class="textConfirmacio">La reserva s'ha confirmat correctament</p>
        </div>
        <table class="contenedorDetallCorreoPDF">
            <tr>
                <th>Hotel:</th>
                <td>{{ $reserva['hotel'] }}</td>
            </tr>
            <tr>
                <th>Habitació:</th>
                <td>{{ $reserva['habitacio'] }}</td>
            </tr>
            <tr>
                <th>Data:</th>
                <td>{{ $reserva['dataInici'] }}</td>
            </tr>
            <tr>
                <th>Preu:</th>
                <td>{{ $reserva['preu'] }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
