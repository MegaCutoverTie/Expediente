<?php 
include "lib/sql.php";
include "lib/colaborador.php";
$tipo = isset($_REQUEST["tipo"])?$_REQUEST["tipo"]:"";

$c = new colaborador();

if($tipo == "1")
{ 
    echo $c->tabla();
}
else if ($tipo == "2")
{
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $app = isset($_POST["app"]) ? $_POST["app"] : "";
    $apm = isset($_POST["apm"]) ? $_POST["apm"] : "";
    $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
    $aux = isset($_POST["aux"]) ? $_POST["aux"] : "";
    $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : "";
    $auxtel = isset($_POST["auxtel"]) ? $_POST["auxtel"] : "";
    $foto = isset($_POST["foto"]) ? $_POST["foto"] : "";

    $dir = "foto/";
    $r = rand();

    if (isset($_FILES["foto"])) {
        if ($_FILES["foto"]["error"] == 0) {
            $extn = explode(".", strtolower($_FILES["foto"]["name"]));
            $target_file = "foto/" . rand() . date("jmy") . "." . end($extn);
            $filetype = pathinfo($target_file, PATHINFO_EXTENSION);

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $c = new colaborador();
                $c->crear($nom, $app, $apm, $tel, $correo, $aux, $fecha, $auxtel, $target_file);
            }
        }
    }
    echo "Colaborador creado exitosamente";
}
else if ($tipo == "3")
{
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    echo $c->modificarPlantilla($id);
}
else if ($tipo == "4")
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $app = isset($_POST["app"]) ? $_POST["app"] : "";
    $apm = isset($_POST["apm"]) ? $_POST["apm"] : "";
    $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
    $aux = isset($_POST["aux"]) ? $_POST["aux"] : "";
    $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : "";
    $auxtel = isset($_POST["auxtel"]) ? $_POST["auxtel"] : "";

    $c->modificar($id, $nom, $app, $apm, $tel, $correo, $aux, $fecha, $auxtel);
    
    echo "Colaborador modificado exitosamente";
}
else if ($tipo == "5")
{
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    echo $c->eliminarPlantilla($id);
}
else if ($tipo == "6")
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $activo = 0;

    $c->eliminar($id, $activo);

    echo "Colaborador eliminado exitosamente";
}
else if ($tipo == "7")
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    echo $c->mostrar($id);
}
else if ($tipo == "8")
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    echo $c->expediente($id);
}
else if ($tipo == "9") 
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $fecha = date('Y-m-d H:i:s');

    if (isset($_FILES['doc']) && $_FILES['doc']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
        $targetDir = "uploads/";
        $targetFile = $targetDir . uniqid() . '.' . $ext;

        if (move_uploaded_file($_FILES['doc']['tmp_name'], $targetFile)) {
            $c = new colaborador();
            $c->subirDoc($id, $targetFile, $fecha);
            echo "Documento subido correctamente";
        } else {
            echo "Error al mover el archivo";
        }
    } else {
        echo "No se recibió archivo o hubo un error en la subida";
    }
}
else if ($tipo == "10") {
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $c->eliminarDoc($id);
    echo "Documento eliminado exitosamente";
}
?>