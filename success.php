<?php
session_start();
require_once("./vendor/autoload.php");
include_once("./db/conexion.php");
include_once("./db/consultas.php");

use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

\Stripe\Stripe::setApiKey('sk_test_51TVq223JiYqRuNkdWHbg1JOQfZrC4zILSIAXiSet4kUfyoyfKsOqQEJl6z5uz6ckxI7RnNt70i3WVzOax7vtSKef00qRUnr611');
$usuario_id = $_SESSION["usuario_id"];
$session_id = $_GET['id'];
$juegos_carrito = $db->listarjuegoscarrito($_SESSION["carrito"]);
$session = \Stripe\Checkout\Session::retrieve($session_id);

// datos
$email = $session->customer_details->email;
$total = $session->amount_total / 100;
$nombre = $session->metadata->customer_name ?? 'Cliente';
$payment_id = $session->payment_intent;
$numero = "FAC-" . date("YmdHis");

//Insertamos el pedido
$id_pedido = $db->insertarpedido($usuario_id);

if (!$id_pedido) {
    die("Error creando pedido");
}
/* =========================
   PROCESAR JUEGOS
========================= */
$juegos_carrito_codificados = [];

foreach ($juegos_carrito as $juego) {

    $codigo = $db->generarCodigoFactura(16);

    // INSERT EN BD
    $db->insertarpedidoitem(
        $id_pedido,
        $juego['id_juego'],
        $juego['horas'],
        $juego['precio_alquiler'],
        $codigo
    );

    // guardar código para factura
    $juego['codigo'] = $codigo;
    $juegos_carrito_codificados[] = $juego;
}

$juegos_carrito = $juegos_carrito_codificados;
include_once "factura_generator.php";
ob_start();

include __DIR__ . "/templates/factura.php";
$html = ob_get_clean();
// crear carpeta
if (!is_dir(__DIR__ . "/facturas")) {
    mkdir(__DIR__ . "/facturas", 0777, true);
}

//Generación del PDF

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

//Enviamos el mail

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

    ob_start();
    include __DIR__ . "/templates/email_facturas.php";
    $mail->Body = ob_get_clean();

    $mail->addAttachment($pdf_path);
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->send();


    if (!$db->reciboExiste($session_id)) {
        $nombre_pdf = $numero . ".pdf";
        $db->insertarpdf($usuario_id, $numero, $nombre_pdf, "pagado", $session_id, $id_pedido);
        //Eliminamos el carrito si todo ha ido bien
        $db->eliminarcarrito($usuario_id);
    }

} catch (Exception $e) {
    echo "Error email: " . $mail->ErrorInfo;
}
?>


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