<?php
// Verifica si se recibieron los datos necesarios
if(isset($_GET['precio']) && isset($_GET['cantidad'])) {
    // Obtiene los valores enviados por AJAX
    $precio_unitario = floatval($_GET['precio']);
    $cantidad = intval($_GET['cantidad']);

    // Calcula el precio normal sin descuento
    $precio_normal = $precio_unitario * $cantidad;

    // Aplica el descuento si se proporcionó un código de promoción
    if(isset($_GET['codigo']) && !empty($_GET['codigo'])) {
        $codigo_promocion = $_GET['codigo'];
        // Lógica para aplicar descuento según el código de promoción
        // Este es solo un ejemplo, debes adaptarlo según tus necesidades
        $descuento = 15; // Supongamos un descuento del 100% para el ejemplo
    } else {
        $descuento = 0; // Sin descuento si no se proporciona código de promoción
    }

    // Calcula el subtotal y el total con el descuento aplicado
    $subtotal = $precio_normal - ($precio_normal * ($descuento / 100));
    $iva = $subtotal * 0.16; // Supongamos un IVA del 16%
    $total = $subtotal + $iva;

    // Prepara los datos para devolver como respuesta AJAX
    $response = array(
        'precionormal' => number_format($precio_normal, 2),
        'descuento' => number_format(($precio_normal - $subtotal), 2),
        'subtotal' => number_format($subtotal, 2),
        'iva' => number_format($iva, 2),
        'total' => number_format($total, 2)
    );

    // Devuelve los datos como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si faltan datos, devuelve un error
    header("HTTP/1.1 400 Bad Request");
    echo "Error: Faltan parámetros requeridos.";
}
?>
