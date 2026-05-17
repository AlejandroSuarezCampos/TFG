<?php
$subtotal = 0;
$iva_total = 0;
$filas = "";

foreach ($juegos_carrito as $juego) {

    $titulo = $juego['titulo'];

    $horas = $juego['horas'];

    $precio_base = $juego['precio_alquiler'];

    $base_linea = $precio_base * $horas;

    $iva_linea = $base_linea * 0.21;

    $total_linea = $base_linea + $iva_linea;

    $subtotal += $base_linea;

    $iva_total += $iva_linea;

    $filas .= "
<tr>

    <td>$titulo</td>

    <td class='text-center'>$horas</td>

    <td class='text-right'>€" . number_format($base_linea, 2) . "</td>

    <td class='text-right'>€" . number_format($iva_linea, 2) . "</td>

    <td class='text-right'>€" . number_format($total_linea, 2) . "</td>

</tr>
";
}

$total_final = $subtotal + $iva_total;
?>