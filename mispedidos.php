<?php
include_once("cabecera.php");
require_once("./db/conexion.php");
require_once("./db/consultas.php");
$id_usuario = $_SESSION["usuario_id"];
$pedidos = $db->getPedidosUsuario($id_usuario);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis pedidos</title>
</head>

<body>

    <div class="containerPedidos main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h1Pedidos">🎮 Mis pedidos</h1>
        <a href="perfil.php" class="btn btn-outline-steam btn-sm">← Volver al perfil</a>
        </div>
        <?php foreach ($pedidos as $p): ?>

            <div class="cardPedidos">

                <div class="infoPedidos">
                    <strong>Pedido #<?= $p['id_pedido'] ?></strong>
                    <div class="facturaPedidos">
                        <?= $p['numero_factura'] ?>
                    </div>
                    <div style="font-size:12px;color:#aaa;">
                        <?= date("d/m/Y H:i", strtotime($p['fecha'])) ?>
                    </div>
                </div>

                <div>
                    <span class="estadoPedidos <?= $p['estado'] ?>">
                        <?= $p['estado'] ?>
                    </span>
                </div>

                <div>
                    <a class="btn btn-steam" href="ver_factura.php?id=<?= $p['id_pedido'] ?>&modo=view">
                        Ver factura
                    </a>
                    <a class="btn btn-steam" href="ver_factura.php?id=<?= $p['id_pedido'] ?>&modo=download">
                        Descargar
                    </a>
                </div>

            </div>

        <?php endforeach; ?>

    </div>
    <?php
    include_once("pie.php");
    ?>