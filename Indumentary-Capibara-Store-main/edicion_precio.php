<?php
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['precio'])) {
    $articuloId = $data['id'];
    $nuevoPrecio = $data['precio'];

    // Ruta al archivo JSON
    $filePath = 'precios.json';

    // Lee el contenido actual del archivo
    $currentContent = file_get_contents($filePath);
    $articles = json_decode($currentContent, true);

    // Actualiza el precio del artículo
    foreach ($articles as &$article) {
        if ($article['id'] == $articuloId) {
            $article['precio'] = $nuevoPrecio;
            break;
        }
    }

    // Vuelve a escribir el archivo con los datos actualizados
    file_put_contents($filePath, json_encode($articles));

    echo json_encode(['message' => 'Precio actualizado correctamente']);
} else {
    echo json_encode(['message' => 'Datos incompletos']);
}
?>