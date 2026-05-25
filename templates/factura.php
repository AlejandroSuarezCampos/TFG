<?php
$css = file_get_contents(__DIR__ . "/factura.css");
?>

<!DOCTYPE html>
<html>
<head>
<style>
<?= $css ?>
</style>
</head>

<body>

<div class='header'>
    <div>
        <div class='title'>Factura</div>
        <div class='invoice-info'>
            <strong>Número de factura:</strong> <?= $numero ?><br>
            <strong>Fecha de emisión:</strong> <?= date('d/m/Y H:i:s') ?>
        </div>
    </div>

    <div class='logo'>
        <img src='http://localhost/TFG/assets/logo.jpg'>
    </div>
</div>

<div class='section'>
    <div class='section-title'>Facturar a</div>

    <div class='client-box'>
        <?= $nombre ?><br>
        España<br>
        <?= $email ?>
    </div>
</div>

<table>
<thead>
<tr>
    <th>Descripción</th>
    <th class='text-center'>Horas</th>
    <th class='text-right'>Código</th>
    <th class='text-right'>Base</th>
    <th class='text-right'>IVA 21%</th>
    <th class='text-right'>Importe</th>
</tr>
</thead>

<tbody>
<?= $filas ?>
</tbody>
</table>

<div class='summary'>
    <div>Subtotal: €<?= number_format($subtotal,2) ?></div>
    <div>IVA: €<?= number_format($iva_total,2) ?></div>
    <div class='total'>TOTAL: €<?= number_format($total_final,2) ?></div>
</div>

</body>
</html>