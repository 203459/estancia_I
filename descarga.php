<?php
// Verificar si se recibió el correo electrónico en la solicitud POST
if (isset($_POST['correo'])) {
    // Obtener el correo electrónico enviado desde el formulario
    $correo = $_POST['correo'];

    // Aquí podrías hacer algo con el correo electrónico si es necesario
    // Por ejemplo, podrías guardarlo en una base de datos o utilizarlo para generar el archivo de descarga

    // Luego, podrías generar el archivo de descarga
    $archivo = 'ruta/al/archivo/a/descargar.pdf'; // Ruta al archivo que deseas descargar

    // Verificar si el archivo existe
    if (file_exists($archivo)) {
        // Establecer encabezados para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); // Tipo MIME del archivo (en este caso, PDF)
        header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
        header('Content-Length: ' . filesize($archivo));
        readfile($archivo); // Leer el contenido del archivo y enviarlo al cliente
        exit;
    } else {
        // Si el archivo no existe, mostrar un mensaje de error
        echo 'El archivo no existe.';
    }
} else {
    // Si no se recibió el correo electrónico, mostrar un mensaje de error
    echo 'Correo electrónico no recibido.';
}
?>
