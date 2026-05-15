<?php
session_start();
require_once("./vendor/autoload.php");
include_once("./db/conexion.php");
include_once("./db/consultas.php");
$juegos_carrito = $db->listarjuegoscarrito($_SESSION["carrito"]);
include 'factura_generator.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

\Stripe\Stripe::setApiKey('sk_test_51TVq223JiYqRuNkdWHbg1JOQfZrC4zILSIAXiSet4kUfyoyfKsOqQEJl6z5uz6ckxI7RnNt70i3WVzOax7vtSKef00qRUnr611');
$usuario_id=$_SESSION["usuario_id"];
$session_id = $_GET['id'];

$session = \Stripe\Checkout\Session::retrieve($session_id);

// datos
$email = $session->customer_details->email;
$total = $session->amount_total / 100;
$nombre = $session->metadata->customer_name ?? 'Cliente';
$payment_id = $session->payment_intent;

$numero = "FAC-" . date("YmdHis");

$html = "
<html>
<head>
<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    color:#1a1a1a;
    margin:40px;
    font-size:14px;
}
.header{
    position: relative;
    margin-bottom: 40px;
    min-height: 120px;
}
.logo{
    position: absolute;
    top: 0;
    right: 0;
}
.logo img{
    width: 280px;
}
.title{
    font-size:34px;
    font-weight:bold;
    margin-bottom:20px;
}
.invoice-info{
    color:#555;
    line-height:1.8;
}
.logo img{
    width:150px;
}
.section{
    margin-top:35px;
}
.section-title{
    font-size:13px;
    text-transform:uppercase;
    color:#777;
    margin-bottom:10px;
    font-weight:bold;
}
.client-box{
    line-height:1.8;
    color:#444;
}
.amount-due{
    margin-top:30px;
    padding:20px;
    background:#f6f9fc;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:35px;
}
thead{
    background:#f6f9fc;
}
th{
    text-align:left;
    padding:14px;
    color:#666;
    font-size:13px;
    border-bottom:1px solid #ddd;
}
td{
    padding:14px;
    border-bottom:1px solid #eee;
    color:#333;
}
.text-center{
    text-align:center;
}
.text-right{
    text-align:right;
}
.summary{
    width:320px;
    margin-left:auto;
    margin-top:35px;
}
.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:12px;
    font-size:15px;
    text-align:right;
}
.summary-row span:last-child{
    min-width:120px;
    text-align:right;
}

.total{
    border-top:2px solid #ddd;
    padding-top:15px;
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
    color:#111;
}
.footer{
    margin-top:60px;
    font-size:12px;
    color:#888;
    text-align:center;
}
</style>
</head>
<body>
<div class='header'>
    <div>
        <div class='title'>Factura</div>
        <div class='invoice-info'>
            <strong>Número de factura:</strong> $numero
            <br>
            <strong>Fecha de emisión:</strong> " . date('d/m/Y H:i:s') . "
        </div>
    </div>
    <div class='logo'>
        <img src='http://localhost/TFG/assets/logo.jpg'>
    </div>
</div>
<div class='section'>
    <div class='section-title'>
        Facturar a
    </div>
    <div class='client-box'>
        $nombre
        <br>
        España
        <br>
        $email
    </div>
</div>

<table>

<thead>

<tr>

    <th>Descripción</th>

    <th class='text-center'>
        Horas
    </th>

    <th class='text-right'>
        Base
    </th>

    <th class='text-right'>
        IVA 21%
    </th>

    <th class='text-right'>
        Importe
    </th>

</tr>

</thead>

<tbody>

    $filas

</tbody>

</table>

<div class='summary'>

    <div class='summary-row'>

        <span>Subtotal</span>

        <span>
            €" . number_format($subtotal, 2) . "
        </span>

    </div>

    <div class='summary-row'>

        <span>IVA total</span>

        <span>
            €" . number_format($iva_total, 2) . "
        </span>

    </div>

    <div class='summary-row total'>

        <span>TOTAL</span>

        <span>
            €" . number_format($total_final, 2) . "
        </span>

    </div>

</div>

<div class='footer'>

    Gracias por tu compra.

</div>

</body>

</html>

";
// crear carpeta
if (!is_dir(__DIR__ . "/facturas")) {
    mkdir(__DIR__ . "/facturas", 0777, true);
}

/* =========================
   1. GENERAR PDF
========================= */

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$pdf_output = $dompdf->output();

$pdf_path = __DIR__ . "/facturas/$numero.pdf";
file_put_contents($pdf_path, $pdf_output);

/* =========================
   2. ENVIAR EMAIL
========================= */

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adminsteamkiller@gmail.com';
    $mail->Password = 'nxzknqelbqctuoxv';
    $mail->SMTPSecure = 'TÑS';
    $mail->Port = 587;

    $mail->setFrom('adminsteamkiller@gmail.com', 'STEAMKILLER');
    $mail->addAddress($email, $nombre);

    $mail->isHTML(true);
    $mail->Subject = "Tu factura $numero";

  $mail->Body = "

<div style='font-family:Arial,sans-serif;color:#222;line-height:1.6;'>

    <h2 style='color:#111;margin-bottom:20px;'>
        Gracias por tu compra
    </h2>

    <p>
        Hemos recibido correctamente tu pedido y el pago se ha realizado con éxito.
    </p>

    <p>
        En el archivo adjunto encontrarás la factura en formato PDF con todos los detalles de la operación.
    </p>

    <p>
        Agradecemos la confianza depositada en nuestra plataforma y esperamos verte de nuevo muy pronto.
    </p>

    <p>
        Si necesitas ayuda o tienes cualquier consulta, nuestro equipo estará encantado de atenderte.
    </p>

    <br>

    <hr style='border:none;border-top:1px solid #ddd;'>

    <p style='font-size:12px;color:#777;'>

        Este correo ha sido generado automáticamente.<br>
        Por favor, no respondas directamente a este mensaje.

    </p>

</div>

";

    $mail->addAttachment($pdf_path);
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->send();
  /*$db->insertarFactura($numero,$usuario_id);
  Antes de eliminar el carrito hay que generar tantos códigos como carritos existan, posible PA
  $db->eliminarcarrito($usuario_id);*/
} catch (Exception $e) {
    echo "Error email: " . $mail->ErrorInfo;
}
?>

<!-- TU UI BONITA -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pago completado</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 60px;
            color: #22c55e
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: #22c55e;
            color: white;
            text-decoration: none;
            border-radius: 10px
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="icon">✔</div>
        <h1>Pago realizado</h1>
        <p>Tu factura ha sido enviada por correo y guardada en tu historial.</p>
        <a href="index.php">Volver</a>
    </div>

</body>

</html>