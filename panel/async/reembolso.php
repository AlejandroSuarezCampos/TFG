<?php
require_once("../db/conexion.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$idPedido = $_POST['id_pedido'];
$motivo = $_POST['motivo'];
// 1. Marcar pedido como reembolsado
$db->reembolsarPedido($idPedido,$motivo);

$mail = new PHPMailer(true);
$email=$db->GetEmail($_SESSION["usuario_id"]);
try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adminsteamkiller@gmail.com';
    $mail->Password = 'nxzknqelbqctuoxv';
    $mail->SMTPSecure = 'TÑS';
    $mail->Port = 587;

    $mail->setFrom('adminsteamkiller@gmail.com', 'STEAMKILLER');
    $mail->addAddress($email["email"], $email["nombre"]);

    $mail->isHTML(true);
    $mail->Subject = "Tu reembolso pedido $idPedido";

    ob_start();
    include __DIR__ . "/templatesPanel/email_reembolso.php";
    $mail->Body = ob_get_clean();

    //$mail->addAttachment($pdf_path);
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->send();

} catch (Exception $e) {
    echo "Error email: " . $mail->ErrorInfo;
}
?>