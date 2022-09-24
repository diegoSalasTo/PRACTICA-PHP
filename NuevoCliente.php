<?php 
$db = new PDO('mysql:host=localhost;dbname=financiera','diego','123456');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $razon_social = $nombres. ' '.$apellidos;
    $tipo_cliente = $_POST['tipoCliente'];
    $tipo_documento = $_POST['tipoDocumento'];
    $numero_documento = $_POST['numeroDocumento'];
    $direccion = $_POST['direccion'];
    $referencia = $_POST['referencia'];

    $sql = "INSERT INTO cliente(`nombres`, `apellidos`, `razon_social`, 
                `direccion`, `referencia`, `id_tipo_cliente`, `id_tipo_documento`, 
                `numero_documento`, `estado`) 
            VALUES ('$nombres','$apellidos','$razon_social','$direccion','$referencia',
                '$tipo_cliente','$tipo_documento','$numero_documento','1')";
    $resultado = $db->query($sql);
    if($resultado){
        header('location:index.php');
    }
    exit;
}

$sql = "SELECT * FROM tipo_cliente";
$resultado = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$tipos_cliente = [];
foreach($resultado as $tipo){
    $tipos_cliente[] = $tipo;
}

$sql = "SELECT * FROM tipo_documento";
$resultado = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$tipos_documento = [];
foreach($resultado as $tipo){
    $tipos_documento[] = $tipo;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Nuevo Cliente</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres:</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos:</label>
                <input type="text" name="apellido" id="apellido" class="form-control">
            </div>

            <div class="mb-3">
                <label for="tipoCliente" class="form-label">Tipo Cliente:</label>
                <select class="form-control" id="tipoCliente" name="tipoCliente">
                    <option value="0">--SELECCIONE--</option>
                    <?php
                    foreach ($tipos_cliente as $tipo) :
                    ?>
                        <option value="<?php echo $tipo['id'] ?>">
                            <?php echo $tipo['nombre'] ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tipoDocumento" class="form-label">Tipo Documento:</label>
                <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                    <option value="0">--SELECCIONE--</option>
                    <?php
                    foreach ($tipos_documento as $tipo) :
                    ?>
                        <option value="<?php echo $tipo['id'] ?>">
                            <?php echo $tipo['nombre'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="numeroDoumento" class="form-label">N° Documento</label>
                <input type="text" name="numeroDocumento" id="numeroDocumento" class="form-control">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>

            <div class="mb-3">
                <label for="referencia" class="form-label">Referencia:</label>
                <textarea name="referencia" id="referencia" rows="5" class="form-control"></textarea>
            </div>

            <input type="submit" value="Grabar" class="btn btn-primary">
        </form>

    </div>
</body>

</html>