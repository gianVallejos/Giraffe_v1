<html>
<head>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 160px 50px;
        }

        header {
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 100px;
            text-align: center;
        }

        header h1 {
            margin: 10px 0;
        }

        header h2 {
            margin: 0 0 10px 0;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            border-bottom: 2px solid #ddd;
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        footer p {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
<body>
<header>
    <h1>Reporte de Ventas</h1>
    <h2>giraffe.pe</h2>
</header>
<footer>
    <table>
        <tr>
            <td>
                <p class="izq">
                    giraffe.pe
                </p>
            </td>
            <td>
                <p class="page">
                    Página
                </p>
            </td>
        </tr>
    </table>
</footer>
<div id="content">
    <table id="tablaVentas">
        <thead>
        <tr>
            <th class="text-center">N°</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Cajero</th>
            <th class="text-center">Monto</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; $cnt = 0; ?>
        @foreach( $ventasDescargar as $venta )
            <tr>
                <td class="text-center">{{ $i }}</td>
                <td class="text-center">{{ $venta->fecha }}</td>
                <td class="text-center">{{ $venta->cajero }}</td>
                <td class="text-center">{{ $venta->monto }}</td>
            </tr>
            <?php $i++;?>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>