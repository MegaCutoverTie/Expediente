<?php
include 'connection.php';

function panel2($id)
{
    $conn="";

    include 'connection.php';
    $sql ="select * from ORGPEISA.dbo.cotit01 where proyid = '$id' and tipo = 1";
    //echo "<br>".$sql;
    $result = sqlsrv_query($conn, $sql);
    $valor = 'n';
    echo "";
    /*echo "<table class=\"table\">
  <thead>
    <tr>
      <th>id</th>
      <th>Producto</th>
    </tr>
  </thead>
  <tbody>";*/

    //echo "<form id=\"formtodo\" method=\"post\" name=\"formtodo\" action=\"\" enctype=\"multipart/form-data\" class=\"form-horizontal\">";
    echo "<div>";
    $con = 0;
    while ($row = sqlsrv_fetch_object($result))
    {
        $con++;
        //echo "<tr><td>$row->Cotizaid</td><td>$row->Producto</td></td>";
        echo "<div class=\"table table-responsive\"><table class=\"table table-bordered\" >";
        echo "<thead>
                    <tr>
														<th colspan=\"2\"  style=\"text-align: center; vertical-align: middle;\">$row->Cotizaid</th>
														<th colspan=\"5\"  style=\"text-align: center; vertical-align: middle;\">$row->Producto</th>
														<th colspan=\"1\"  style=\"text-align: center; vertical-align: middle;\">
														
														    <div class=\"checkbox i-checks\"><input type=\"checkbox\" name='check$con' id =\"check$con\" value=\"$row->Cotizaid\"> <i></i></div>
														</th>
													</tr>
                    <tr>
														<th class=\"col-sm-1\" style=\"text-align: center; vertical-align: middle;\">No.</th>
														<th class=\"col-sm-1\" style=\"text-align: center; vertical-align: middle;\">Parámetro</th>
														<th class=\"col-sm-2\" style=\"text-align: center; vertical-align: middle;\">Target</th>
														<th class=\"col-sm-1\" style=\"text-align: center; vertical-align: middle;\">Unidades</th>
														<th class=\"col-sm-2\" style=\"text-align: center; vertical-align: middle;\">Resultado</th>
														<th class=\"col-sm-2\" style=\"text-align: center; vertical-align: middle;\">Adjunto</th>
														<th class=\"col-sm-2\" style=\"text-align: center; vertical-align: middle;\">Observaciones</th>
														<th class=\"col-sm-1\" style=\"text-align: center; vertical-align: middle; min-width: 170px;\">Selecciona prototipo para enviar a comercial</th>
													</tr>
                    </thead>";
        $c =0;
        $sql2 ="select * from formato where idpro ='$id' and idcotiza='$row->Cotizaid'";
        $result2 = sqlsrv_query($conn, $sql2);
        while ($row2 = sqlsrv_fetch_object($result2))
        {
            $c++;
            echo "<tr>
														<td class=\"col-sm-1\" style=\"vertical-align: middle;\">$c</td>
														<td class=\"col-sm-1\" style=\"vertical-align: middle;\">$row2->parametro</td>
														<td class=\"col-sm-2\" style=\"vertical-align: middle;\">$row2->objetvo</td>
														<td class=\"col-sm-1\" style=\"vertical-align: middle;\">$row2->unidades</td>
														
														<td class=\"col-sm-2\" style=\"vertical-align: middle;\">
															<input name=\"resultado$row->Cotizaid"."a$c\" id=\"resultado$row->Cotizaid"."a$c\" type=\"text\" class=\"form-control\" value=\"$row2->resultado\">
														</td>
														<td class=\"col-sm-2 text-center\" style=\"vertical-align: middle;\">";
            if ($row2->adjunto != "")
            {
                echo "<a href=\"$row2->adjunto\" target=\"_blank\">fichero</a>";
            }
            else if ($row2->resultado != "")
            {
                echo "";
            }
            else
            {
                echo "<div class=\"input-group\">
																<label class=\"input-group-btn\">
																	<span class=\"btn btn-primary\" style=\"font-size: 20px;\">
																		<!-- para multiples archivos -----
																		Adjunta brief <input type=\"file\" name=\"adj_formula\" id=\"adj_formula\" style=\"display: none;\" multiple>
																		-->
																		<i class=\"fa fa-upload\"></i><input type=\"file\" name=\"adj_resulta$row->Cotizaid"."a$c\" id=\"adj_resulta$row->Cotizaid"."a$c\" style=\"display: none;\">
																	</span>
																</label>
																<input type=\"text\" class=\"form-control\" id='file$row->Cotizaid"."a$c' readonly>
															</div>";
            }

            echo "</td>
														<td class=\"col-sm-2\" style=\"vertical-align: middle;\">
															<input name=\"observaciones$row->Cotizaid"."a$c\" id=\"observaciones$row->Cotizaid"."a$c\" type=\"text\" value=\"$row2->observaciones\" class=\"form-control\">
														</td>
														<td class=\"col-sm-1\" style=\"text-align: center; vertical-align: middle;\">";

            if ( $row2->resultado == "" )
            {
                echo "<input name=\"estado\" id=\"estado\" value=\"0\" type=\"hidden\" class=\"form-control\"><button class=\"btn btn-primary\" onclick=\"upload('$row2->idpro', '$row->Cotizaid','$row2->idrequisitos', '$c')\"><i class=\"fa fa-save\" style=\"font-size: 20px;\"></i></button>";
            }


            echo "    									</td>
														</td></tr>";
        }
        echo "</table></div>";
        //echo "</form>";
    }
    echo "<input name=\"estado\" id=\"estado\" value=\"0\" type=\"hidden\" class=\"form-control\"><input name=\"contador\" id=\"contador\" value=\"$con\" type=\"hidden\" class=\"form-control\"></div>";
    /*echo "  </tbody>
</table>";*/
    echo "
<div class=\"form-group\">
										<div class=\"col-sm-12 text-right\">
											<button name=\"btn_enviar\"  class=\"btn btn-primary\" onclick=\"muestra(6)\">Enviar 	</button>
										</div>
									<br></div></form>";

    echo "<script>$(document).ready( function() {
                    $(':file').on('fileselect', function(event, numFiles, label) {
                        var input = $(this).parents('.input-group').find(':text'),
                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                        if( input.length ) {
                            input.val(log);
                        } else {
                            if( log ) alert(log);
                        }
                    });
                });
</script>";
    echo "<script>$('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });</script>";
}



$target_dir = "files2/";

$uploadOk = 1;
$id           = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
$cotizaid     = isset($_REQUEST["cotizaid"]) ? $_REQUEST["cotizaid"] : "";
$idrequisitos = isset($_REQUEST["idrequisitos"]) ? $_REQUEST["idrequisitos"] : "";

$resultado     = isset($_REQUEST["resultado"]) ? $_REQUEST["resultado"] : "";
$observaciones = isset($_REQUEST["observaciones"]) ? $_REQUEST["observaciones"] : "";
$adj_resulta   = isset($_REQUEST["adj_resulta"]) ? $_REQUEST["adj_resulta"] : "";

$r = rand();
$sql ="update formato set resultado= '$resultado', adjunto='' ,observaciones = '$observaciones' where idpro = '$id' and idcotiza = '$cotizaid' and idrequisitos = '$idrequisitos'";

if (isset($_FILES['files1'])){
    //echo "entra";
    if ($_FILES['files1']['error'] == 0)
    {
        //$target_file = $target_dir . basename($_FILES["files1"]["name"]);
        $userfile_extn = explode(".", strtolower($_FILES['files1']['name']));
        $target_file ="files2/". rand()  .  date("jmy"). "." . end($userfile_extn) ;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["files1"]["tmp_name"]);
        if ($check !== false)
        {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else
        {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
        if (move_uploaded_file($_FILES["files1"]["tmp_name"], $target_file))
        {
            $sql ="update formato set resultado= '$resultado', adjunto='$target_file' ,observaciones = '$observaciones' where idpro = '$id' and idcotiza = '$cotizaid' and idrequisitos = '$idrequisitos'";
            //echo "The file " . basename($_FILES["files1"]["name"]) . " has been uploaded.";
        }
        else
        {
            $sql ="update formato set resultado= '$resultado', adjunto='' ,observaciones = '$observaciones' where idpro = '$id' and idcotiza = '$cotizaid' and idrequisitos = '$idrequisitos'";
            //echo "Sorry, there was an error uploading your file.";
        }
    }
}
$result = sqlsrv_query($conn, $sql);
panel2($id);

?>