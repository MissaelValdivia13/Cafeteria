<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar XML</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include 'platillos.php';
$conn = Conectarse();

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;

$productos = $dom->createElement('productos');
$dom->appendChild($productos);

$query = "SELECT m.IdProducto as id, c.Descripcion AS CategoriaDescripcion, m.NombreProducto, m.Descripcion, m.Receta, m.Precio, m.Foto FROM menus as m INNER JOIN categoria as c on c.IdCategoria = m.CategoriaId";
$resultado = mysqli_query($conn, $query);

if ($resultado) {
    while ($row = mysqli_fetch_array($resultado)) {
        $producto = $dom->createElement('producto');
        
        $producto->setAttribute('IdProducto', $row['id']);

        $categoriaElement = $dom->createElement('Categoria', $row['CategoriaDescripcion']);
        $producto->appendChild($categoriaElement);

        $nombreElement = $dom->createElement('NombreProducto', $row['NombreProducto']);
        $producto->appendChild($nombreElement);

        $descripcionElement = $dom->createElement('Descripcion', $row['Descripcion']);
        $producto->appendChild($descripcionElement);

        $recetaElement = $dom->createElement('Receta', $row['Receta']);
        $producto->appendChild($recetaElement);

        $precioElement = $dom->createElement('Precio', $row['Precio']);
        $producto->appendChild($precioElement);

        $fotoElement = $dom->createElement('Foto', $row['Foto']);
        $producto->appendChild($fotoElement);

        $productos->appendChild($producto);
    }

?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
            Swal.fire({
                title: "Se generó correctamente el archivo XML",
                text: "¿Desea descargarlo?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Sí, descargar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    var link = document.createElement("a");
                    link.href = "productos.xml";
                    link.download = "productos.xml";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    Swal.fire(
                        'Descargado',
                        'El archivo XML ha sido descargado.',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Cancelado',
                        'La descarga del archivo XML ha sido cancelada.',
                        'error'
                    );
                }
            });
        </script>
<?php
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
