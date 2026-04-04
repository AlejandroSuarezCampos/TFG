<?php
session_start();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if(isset($_SESSION["carrito"][$id])){
        unset($_SESSION["carrito"][$id]);
        $_SESSION["carrito_total"]=count($_SESSION["carrito"]);
         echo json_encode([
        'ok' => true,
         'total' => $_SESSION['carrito_total']
    ]);
    
        }else {   
     echo json_encode([
        'ok' => false,
        'msg' => 'Prodcuto no existente'
    ]);
}
}else{
     echo json_encode([
        'ok' => false,
        'msg' => 'ID no recibido'
    ]);
}
?>