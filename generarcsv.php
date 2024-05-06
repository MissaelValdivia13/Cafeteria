<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include 'platillos.php';
$conn = Conectarse();
$archivo_csv = fopen('productos.csv','w');
if($archivo_csv){
    fputs($archivo_csv, "IdProducto, Categoria, NombreProducto, Descripcion, Receta, Precio, Foto".PHP_EOL);
    $query = "SELECT m.IdProducto as id, c.Descripcion AS CategoriaDescripcion, m.NombreProducto, m.Descripcion, m.Receta, m.Precio, m.Foto FROM menus as m INNER JOIN categoria as c on c.IdCategoria = m.CategoriaId"; 
    $resultado = mysqli_query($conn, $query);
    if($resultado){
        while ($row = mysqli_fetch_array($resultado)){
            $fila = "$row[0], '$row[1]', '$row[2]', '$row[3]', '$row[4]', $row[5], '$row[6]'";
            fputs($archivo_csv, $fila.PHP_EOL);
        }
        fclose($archivo_csv);
?>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                title: "Se generó correctamente el archivo CSV",
                text: "¿Desea descargarlo?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Sí, descargar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    var link = document.createElement("a");
                    link.href = "productos.csv";
                    link.download = "productos.csv";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    Swal.fire(
                        'Descargado',
                        'El archivo CSV ha sido descargado.',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Cancelado',
                        'La descarga del archivo CSV ha sido cancelada.',
                        'error'
                    );
                }
            });
        </script>
<?php
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }
} else {
    echo "Error al abrir el archivo CSV para escritura.";
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>