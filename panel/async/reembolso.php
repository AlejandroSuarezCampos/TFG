<?php
require_once("../db/conexion.php");
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$idPedido = $_POST['id_pedido'];
$motivo = $_POST['motivo'];
header('Content-Type: application/json');
//revisar que no este ya canejado en un alquiler
if($db->pedidoYacanjeado($idPedido)>0){
  echo json_encode([
                "error" => true,
                "type" => "canjeado",
                "message" => "Este pedido ya tiene código canjeado "
            ]);

            exit;
}
// 1. Marcar pedido como reembolsado

$db->reembolsarPedido($idPedido,$motivo);

$mail = new PHPMailer(true);
$email=$db->GetEmail($idPedido);
try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adminsteamkiller@gmail.com';
    $mail->Password = 'nxzknqelbqctuoxv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('adminsteamkiller@gmail.com', 'STEAMKILLER');
    $mail->addAddress($email["email"], $email["nombre"]);

    $mail->isHTML(true);
    $mail->Subject = "Tu reembolso pedido $idPedido";

    ob_start();
    include __DIR__ . "/../templatesPanel/email_reembolso.php";
    $mail->Body = ob_get_clean();

    //$mail->addAttachment($pdf_path);
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->send();
     echo json_encode([
                "exito"=>true,
                "message" => "Reembolsado correctamente"
            ]);
} catch (Exception $e) {
    echo json_encode([
                "error" => true,
                "type" => "canjeado",
                "message" => "Este pedido ya tiene código canjeado "
            ]);
}
?>