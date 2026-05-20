<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago cancelado</title>

    <style>

        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .card{
            background:white;
            padding:40px;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
            text-align:center;
            max-width:420px;
        }

        .icon{
            font-size:70px;
            color:#ef4444;
        }

        h1{
            margin-top:20px;
            color:#111827;
        }

        p{
            color:#6b7280;
            margin:15px 0 30px;
            line-height:1.5;
        }

        a{
            display:inline-block;
            padding:14px 28px;
            background:#ef4444;
            color:white;
            text-decoration:none;
            border-radius:10px;
            transition:0.2s;
        }

        a:hover{
            opacity:0.9;
        }

    </style>

</head>
<body>

    <div class="card">

        <div class="icon">
            ✖
        </div>

        <h1>Pago cancelado</h1>

        <p>
            El proceso de pago fue cancelado o no pudo completarse.
        </p>

        <a href="carrito.php">
            Intentar nuevamente
        </a>

    </div>

</body>
</html>