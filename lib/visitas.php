<?php
class visitas
{
    public $conn;

    public function __construct()
    {
        $this->conn = new sql();
    }

    public function llave($id)
    {
        $fecha = date("ymd");
        $r = rand(1, 100);

        $line = $id . $fecha . $r;
        return $line;
    }

    public function idNext()
    {
        $sql = "select max(folio) next from visita";

        $result = $this->conn->select($sql);
        $next = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $next = intval($row["next"]);
            }
        }
        $next++;
        return $next;
    }

    public function crear($id, $cliente, $puesto, $correo, $nombre, $objetivo, $descrip, $comercial , $conjunto)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaNow = date("Y-m-d H:i:s");
        $idF = $this->llave($id);
        $llave = md5($idF . "PEISA@@°°°|||");
        $next = $this->idNext();
        $sql = "insert into visita(id,usuario, folio, llave, cliente , puesto  , correo  , nombre  , objetivo, descrip , fecha, estado, comercial, fechalog, conjunto)
         values('" . $idF . "','" . $id . "','" . $next . "','" . $llave . "','" . $cliente . "','" . $puesto . "','" . $correo . "','" . $nombre . "','" . $objetivo . "','" . $descrip . "', '" . $fechaNow . "' ,1 , '" . $comercial . "', '" . $fechaNow . "','" . $conjunto . "')";

        //echo $sql;
        $result = $this->conn->select($sql);
        return $idF;
    }
    public function crear2($id, $cliente, $puesto, $correo, $nombre, $objetivo, $descrip, $comercial, $llave)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaNow = date("Y-m-d H:i:s");
        $sql = "UPDATE visita SET puesto = '" . $puesto . "', correo = '" . $correo . "', nombre = '" . $nombre . "', objetivo = '" . $objetivo . "' ,  descrip = '" . $descrip . "', estado = '1', fechapro = '" . $fechaNow . "', fechalog = '" . $fechaNow . "' WHERE id = '" . $llave . "'";

        //echo $sql;
        $result = $this->conn->select($sql);
        return $llave;
    }

    public function crear3($id , $usuario, $folio, $llave, $comercial, $cliente, $puesto, $correo, $nombre, $objetivo, $descrip, $fechalog, $fechapro, $fecha, $fechafin, $estado, $conclusiones, $compromiso, $firma1, $firma2)
    {
        echo "busacarLLave: " . $this->busacarLLave($llave);
        if($this->busacarLLave($llave)== 0)
        {
            $fechapror = $fechapro;
            if($fechapror == '0000-00-00 00:00:00')
            {

            }
            //$llave = md5($idF . "PEISA@@°°°|||");
            $next = $this->idNext();
            //$sql = "insert into visita(id, usuario, folio, llave, comercial, cliente, puesto, correo, nombre, objetivo, descrip, fechalog, fechapro, fecha, fechafin, estado, conclusiones, compromiso, firma1, firma2)
            // values('" . $id . "','" . $usuario . "','" . $next . "','" . $llave ."','" . $comercial . "','" . $cliente . "','" . $puesto . "','" . $correo . "','" . $nombre . "','" . $objetivo . "','" . $descrip . "','" . $fechalog."','". $fechapro . "','" . $fecha ."','" . $fechafin ."','" . $estado."','" . $conclusiones . "','" .$compromiso . "' , 'data:image/png;base64," . $firma1 . "','data:image/png;base64,".$firma2 ."')";
    
            $sql = "insert into visita(id, usuario, folio, llave, comercial, cliente, puesto, correo, nombre, objetivo, descrip, fechalog, fechapro, fecha, fechafin, estado, conclusiones, compromiso, firma1, firma2)
             values('" . $id . "','" . $usuario . "','" . $next . "','" . $llave ."','" . $comercial . "','" . $cliente . "','" . $puesto . "','" . $correo . "','" . $nombre . "','" . $objetivo . "','" . $descrip . "','" . $fechalog."',null,'" . $fecha ."','" . $fechafin ."','" . $estado."','" . $conclusiones . "','" .$compromiso . "' , 'data:image/png;base64," . $firma1 . "','data:image/png;base64,".$firma2 ."')";
    
            //echo $sql . "\n";
            $result = $this->conn->select($sql);
            return $id;
        }
        return 0;
    }

    public function busacarLLave($llave)
    {
        $sql = "select count(id) total from visita where llave = '" . $llave . "'";
        //echo $sql. "\n";
        $result = $this->conn->select($sql);
        $salida = 0; 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                $salida = $row["total"];
            }
        }
        return $salida;
    }
    public function consultar($id)
    {
        $sql = "select id, cliente , puesto  , correo  , nombre  , objetivo, descrip , fecha from visita";

        $result = $this->conn->select($sql);
        $linea = "<table>
        <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Nombre</th>
        <th></th>
        <tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $linea .= "<tr>";
                $linea .= "<td>" . $row["id"] . "</td>";
                $linea .= "<td>" . $row["cliente"] . "</td>";
                $linea .= "<td>" . $row["nombre"] . "</td>";
                $linea .= "<td></td>";
                $linea .= "</tr>";
            }
        }
        $linea .= "</table>";
    }

    public function cliente()
    {
        $sql = "select * from contacto where id='' and estado = ''";
        $result = $this->conn->select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            }
        }
    }

    public function visitaFind($id)
    {
        $sql = "SELECT * FROM visita where id = '" . $id . "'";
        $result = $this->conn->select($sql);
        $nom = "";
        $puesto = "";
        $correo = "";
        $objetivo = "";
        $desc = "";
        $cliente = "";
        $conjunto = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                $cliente = $row["cliente"];
                $nom = $row["nombre"];
                $puesto = $row["puesto"];
                $correo = $row["correo"];
                $objetivo = $row["objetivo"];
                $desc = $row["descrip"];
                $conjunto = $row["conjunto"];
            }
        }

        $conjunto = $conjunto == "" ? "": '<p>Visitas Conjuntas:<br><b>' . $conjunto . '</b></p>';

        $cadena = '<div class="card">
                    <div class="card-header">
                        <h6>
                            ' . $cliente . '
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item form-select ">
                            <div class="d-grid gap-2">
                                <a class="btn text-start" data-bs-toggle="collapse" href="#collapse0" role="button"
                                    aria-expanded="false" aria-controls="collapse0">
                                    <p>Nombre de Contacto: <br><b>' . $nom . '</b></p>    
                                </a>
                            </div>
                            <div class="collapse" id="collapse0"><br>
                                <p>Puesto de la Persona que se Visita:<br>
                                    <b>' . $puesto . '</b></p>
                                <p>Correo Electronico:<br>
                                <b>' . $correo . '</b></p>
                                <p>Objetivo:<br>
                                <b>' . $objetivo . '</b></p>' . $conjunto . '
                                <p>Descripción:<br>
                                <b>' . $desc . '</b></p>
                            </div>
                        </li>
                    </ul>
                </div>';
        return $cadena;
    }
    function updateVisita($id, $descrip, $compromiso)
    {
        $sql = "update visita set estado = '2', conclusiones ='" . $descrip . "' , compromiso ='" . $compromiso . "' where id = '" . $id . "' and estado != '5'"; //1
        //echo $sql;
        $result = $this->conn->select($sql);
        return $id;
    }

    function updateVisita2($id)
    {
        $sql = "update visita set estado = '3' where id = '" . $id . "' and estado != '5'"; //2
        //echo $sql;
        $result = $this->conn->select($sql);
        return $id;
    }

    function updateVisita3($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaNow = date("Y-m-d H:i:s");
        $sql = "update visita set estado = '5' , fechafin= '" . $fechaNow . "'  where id = '" . $id . "' and estado != '5'"; //4
        //echo $sql;
        $result = $this->conn->select($sql);
        return $id;
    }

    function mandarCorreo($id)
    {
        $sql = "SELECT v.correo, u.correo correo2 , llave, folio FROM `visita` v inner join usuarioweb u on v.usuario = u.usuario where v.id = '" . $id . "'";
        $result = $this->conn->select($sql);

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                //echo $row["correo"].  ", ". "FORMATO DE VISITA A CLIENTE FOLIO: " . $row["correo2"]. "https://cenidep.mx/app/pdf.php?id=" . $row["llave"] . "&ran=0.03490113949711171";
                mail($row["correo"]. "," . $row["correo2"] , "FORMATO DE VISITA A CLIENTE FOLIO: " . $row["folio"] ." - ". $row["correo2"] , "Se envia formato de visita a cliente con folio: " . $row["folio"] .  " https://cenidep.mx/app/pdf.php?id=" . $row["llave"] . "&ran=0.03490113949711171");
            }
        }
    }

    function usuario($id)
    {
        $sql = "SELECT * FROM visita where id = '" . $id . "'";
        $result = $this->conn->select($sql);

        $nom = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row["nombre"];
            }
        }

        return $nom;
    }

    function titulo($id)
    {
        $sql = "SELECT * FROM visita where id = '" . $id . "'";
        $result = $this->conn->select($sql);

        $nom = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row["cliente"];
            }
        }

        return $nom;
    }

    
    function firma1($id, $firma)
    {
        $sql = "update visita set estado = '4', firma1 ='" . $firma . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        $img = str_replace("data:image/png;base64,", "", $firma);
        $decoded = base64_decode($img);
        $file = 'invoice.pdf';
        $firmaAux = "firma". $this->getKet($id). "-1.png";
        //echo "\n\n".$firmaAux ."\n\n";
        file_put_contents("7236a9723ea216e487c60739f0293a0a/" . $firmaAux, $decoded);
        if (file_exists($file)) {

            header('Content-Description: File Transfer');
        
            header('Content-Type: application/octet-stream');
        
            header('Content-Disposition: attachment; filename="'.basename($firmaAux).'"');
        
            header('Expires: 0');
        
            header('Cache-Control: must-revalidate');
        
            header('Pragma: public');
        
            header('Content-Length: ' . filesize($firmaAux));
        
            readfile($firmaAux);
        
            exit;
        
        }
        return $id;
    }

    function firma2($id, $firma)
    {
        $sql = "update visita set estado = '4', firma2 ='" . $firma . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        $img = str_replace("data:image/png;base64,", "", $firma);
        $decoded = base64_decode($img);
        $file = 'invoice.pdf';
        $firmaAux = "firma". $this->getKet($id). "-2.png";
        file_put_contents("7236a9723ea216e487c60739f0293a0a/" . $firmaAux, $decoded);
        if (file_exists($file)) {

            header('Content-Description: File Transfer');
        
            header('Content-Type: application/octet-stream');
        
            header('Content-Disposition: attachment; filename="'.basename($firmaAux).'"');
        
            header('Expires: 0');
        
            header('Cache-Control: must-revalidate');
        
            header('Pragma: public');
        
            header('Content-Length: ' . filesize($firmaAux));
        
            readfile($firmaAux);
        
            exit;
        
        }
        return $id;
    }

    function firma2Movil($id, $firma)
    {
        $sql = "update visita set firma2 ='data:image/png;base64," . $firma . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        return $id;
    }
    function firma1Movil($id, $firma)
    {
        $sql = "update visita set firma1 ='data:image/png;base64," . $firma . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        return $id;
    }

    public function firmas($id)
    {
        $sql = "select id, firma1 , firma2, comercial, nombre from visita where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);

        $aux = "";
        $firma1 = "";
        $firma2 = "";
        $nom1 = "";
        $nom2 = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $firma1 = $row["firma1"];
                $firma2 = $row["firma2"];
                $nom1 = $row["comercial"];
                $nom2 = $row["nombre"];
            }
        }
        $num = 0;
        $aux = '
                <div class="col-6 text-center">
                    <div class="card  mt-2">
                        <div class="card-body firma" id="firma1" style="min-height: 145px;">';
        if ($firma1 != "") {
            $aux .= '<img src="' . $firma1 . '" style="width: 100%;"/>';
            $num++;
        }
        $aux .= '            
                        </div>
                    </div>
                    <p>Firma Del Respr PEISA<br>' . $nom1 . '</p>
                </div>
                <div class="col-6 text-center">
                    <div class="card  mt-2">
                        <div class="card-body firma" id="firma2" style="min-height: 145px;">';
        if ($firma2 != "") {
            $aux .= '<img src="' . $firma2 . '" style="width: 100%;"/>';
            $num++;
        }
        $aux .= ' 
                        </div>
                    </div>
                    <p>Firma Del Respr Cliente<br>' . $nom2 . '</p>
                </div>';
        $aux .= '<input type="hidden" value="' . $num . '" name="validarFirma" id="validarFirma">';

        echo $aux;
    }

    public function firmas2($id)
    {
        $sql = "select id, firma1 , firma2, comercial, nombre from visita where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);

        $aux = "";
        $firma1 = "";
        $firma2 = "";
        $nom1 = "";
        $nom2 = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $firma1 = $row["firma1"];
                $firma2 = $row["firma2"];
                $nom1 = $row["comercial"];
                $nom2 = $row["nombre"];
            }
        }
        $num = 0;
        $aux = '
                <div class="col-6 text-center">
                    <div class="card  mt-2">
                        <div class="card-body firma" id="firma" style="min-height: 145px;">';
        if ($firma1 != "") {
            $aux .= '<img src="' . $firma1 . '" style="width: 100%;"/>';
            $num++;
        }
        $aux .= '            
                        </div>
                    </div>
                    <p>Firma Del Respr PEISA<br>' . $nom1 . '</p>
                </div>
                <div class="col-6 text-center">
                    <div class="card  mt-2">
                        <div class="card-body firma" id="firma" style="min-height: 145px;">';
        if ($firma2 != "") {
            $aux .= '<img src="' . $firma2 . '" style="width: 100%;"/>';
            $num++;
        }
        $aux .= ' 
                        </div>
                    </div>
                    <p>Firma Del Respr Cliente<br>' . $nom2 . '</p>
                </div>';
        $aux .= '<input type="hidden" value="' . $num . '" name="validarFirma" id="validarFirma">';

        echo $aux;
    }
    public function getKet($id)
    {
        $sql = "select llave from visita where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $key = $row["llave"];
            }
        }
        return $key;
    }
    public function obj($llave)
    {
        $sql = "select id, folio, llave, comercial, cliente, puesto, correo, nombre, objetivo, descrip, date_format(fechapro, '%d-%m-%Y') as fechapro, date_format(fecha, '%d-%m-%Y') as  fecha, date_format(fechafin, '%d-%m-%Y') as fechafin, estado, conclusiones, compromiso, firma1, firma2 from visita where llave = '" . $llave . "'";

        $result = $this->conn->select($sql);

        $obj = new stdClass();

        $obj->id = "";
        $obj->folio = "";
        $obj->comercial = "";
        $obj->nombre = "";
        $obj->cliente = "";
        $obj->objetivo = "";
        $obj->descrip = "";
        $obj->puesto = "";
        $obj->fecha = "";
        $obj->fechafin = "";
        $obj->conclusiones = "";
        $obj->compromiso = "";
        $obj->firma1 = "";
        $obj->firma2 = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obj->id = $row["id"];
                $obj->folio = $row["folio"];
                $obj->comercial = $row["comercial"];
                $obj->nombre = $row["nombre"];
                $obj->cliente = $row["cliente"];
                $obj->objetivo = $row["objetivo"];
                $obj->puesto = $row["puesto"];
                $obj->descrip = $row["descrip"];
                $obj->fecha = $row["fecha"];
                $obj->fechafin = $row["fechafin"];
                $obj->conclusiones = $row["conclusiones"];
                $obj->compromiso = $row["compromiso"];
                $obj->firma1 = $row["firma1"];
                $obj->firma2 = $row["firma2"];
            }
        }
        return $obj;
    }

    function preVisita($id, $cliente, $puesto, $correo, $nombre, $idCliente, $fechaf, $comercial)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaNow = date("Y-m-d H:i:s");
        $idF = $this->llave($id);
        $llave = md5($idF . "PEISA@@°°°|||");
        $next = $this->idNext();
        $sql = "insert into visita(id, usuario ,folio, llave, cliente , puesto  , correo  , nombre , fechapro, estado, comercial, fechalog, fechaInicio) 
        values('" . $idF . "','" . $id . "','" . $next . "','" . $llave . "','" . $cliente . "','" . $puesto . "','" . $correo . "','" . $nombre . "',STR_TO_DATE('" . $fechaf . "', '%d/%m/%Y'),0 , '" . $comercial . "','". $fechaNow ."', '". $fechaNow ."')";

        //echo "<br>". $sql;
        $result = $this->conn->select($sql);
        return $idF;
    }

    function estado($id)
    {
        if ($id == 1) {
            return "estadoRegistroDeVisita";
        } else if ($id == 2) {
            return "estadoVisitaEnProceso";
        } else if ($id == 3) {
            return "estadoCompromisos";
        } else if ($id == 4) {
            return "estadoFirma";
        } else if ($id == 5) {
            return "estadoEnviarResultado";
        } elseif ($id == 0) {
            return "estadoSave";
        }
    }

    function img($id)
    {
        if ($id == 1) {
            return "img/v.png";
        } else if ($id == 2) {
            return "img/c.png";
        } else if ($id == 3) {
            return "img/e.png";
        } else if ($id == 4) {
            return "img/e.png";
        } else if ($id == 5) {
            return "img/t.png";
        } elseif ($id == 0) {
            return "img/r.png";
        }
    }

    function liga($id, $estado)
    {
        if ($estado == 1) {
            return "proceso.php?tipo=101&clave=" . $id . "&ran=" . rand();
        } else if ($estado == 2) {
            return "compromiso.php?clave=" . $id . "&ran=" . rand();
        } else if ($estado == 3) {
            return "visita.php?clave=" . $id . "&ran=" . rand();
        } else if ($estado == 4) {
            return "visita.php?clave=" . $id . "&ran=" . rand();
        } else if ($estado == 5) {
            return "finalizar.php?clave=" . $id . "&ran=" . rand();
        } else if ($estado == 0) {
            return "registroedit.php?clave=" . $id . "&ran=" . rand();
        }
    }
    function VisitasCliente($id)
    {
        $sql = "select id, cliente , date_format( fechapro, '%d/%m/%Y') as fechapro, date_format(fecha, '%d/%m/%Y') as fecha , estado, nombre from visita where id like '" . $id . "%' and ( ( year(fecha) = year(now()) and month(fecha) = month(now()) and day(fecha) = day(now()) ) or ( year(fechapro) = year(now()) and month(fechapro) = month(now()) and day(fechapro) = day(now()) ))";

        $result = $this->conn->select($sql);

        //echo $sql . "<br>";

        $aux = "";
        while ($row = $result->fetch_assoc()) {
            $aux .= '<div class="d-flex bd-highlight mb-3 border-bottom border-dashed">';
            $fechaInicio = $row['fechapro'] == "" ? $row['fecha'] : $row['fechapro'];

            $aux .= '
            <div class="p-2 bd-highlight">
                <img class="rounded-circle  ' . $this->estado($row['estado']) . '" src="' . $this->img($row['estado']) . '" alt="">
            </div>
            <div class="p-2 bd-highlight">
                <a class="text-decoration-none flex-1 link" href="' . $this->liga($row['id'], $row['estado']) . '">
                    <h5>' . $row['cliente'] . '</h5>
                    <p class="text-700 fw-semi-bold fs--1 mb-0 lh-sm line-clamp-1">' . $row['nombre'] . '</p>
                </a>
            </div>
            <div class="ms-auto p-2 bd-highlight">' . $fechaInicio . '</div>
            ';
            $aux .= "</div>";
        }


        return $aux;
    }

    function VisitasClientef($id)
    {
        $sql = "select id, cliente, date_format( fechapro, '%d/%m/%Y') as fechapro, date_format(fecha, '%d/%m/%Y') as fecha , estado, nombre from visita where id like '" . $id . "%' and (fecha > concat(year(now()),'/',month(now()) , '/', day(now()),' 23:59.00') 
        or fechapro > concat(year(now()),'/',month(now()) , '/', day(now()),' 23:59.00') )";
        $result = $this->conn->select($sql);

        //echo $sql . "<br>";

        $aux = "";
        while ($row = $result->fetch_assoc()) {
            $aux .= '<div class="d-flex bd-highlight mb-3 border-bottom border-dashed">';
            $fechaInicio = $row['fechapro'] == "" ? $row['fecha'] : $row['fechapro'];

            $aux .= '
            <div class="p-2 bd-highlight">
                <img class="rounded-circle  ' . $this->estado($row['estado']) . '" src="' . $this->img($row['estado']) . '" alt="">
            </div>
            <div class="p-2 bd-highlight">
                <a class="text-decoration-none flex-1 link" href="' . $this->liga($row['id'], $row['estado']) . '">
                    <h5>' . $row['cliente'] . '</h5>
                    <p class="text-700 fw-semi-bold fs--1 mb-0 lh-sm line-clamp-1">' . $row['nombre'] . '</p>
                </a>
            </div>
            <div class="ms-auto p-2 bd-highlight">' . $fechaInicio . '</div>
            ';
            $aux .= "</div>";
        }


        return $aux;
    }

    function VisitasClientep($id)
    {
        $sql = "select id,cliente , date_format( fechapro, '%d/%m/%Y') as fechapro, date_format(fecha, '%d/%m/%Y') as fecha , estado, nombre from visita where id like '" . $id . "%' and (fecha < concat(year(now()),'/',month(now()) , '/', day(now()),' 00:00.00') 
        or fechapro < concat(year(now()),'/',month(now()) , '/', day(now()),' 00:00.00') )";
        $result = $this->conn->select($sql);

        //echo $sql . "<br>";

        $aux = "";
        while ($row = $result->fetch_assoc()) {
            $aux .= '<div class="d-flex bd-highlight mb-3 border-bottom border-dashed">';
            $fechaInicio = $row['fechapro'] == "" ? $row['fecha'] : $row['fechapro'];

            $aux .= '
            <div class="p-2 bd-highlight">
                <img class="rounded-circle  ' . $this->estado($row['estado']) . '" src="' . $this->img($row['estado']) . '" alt="">
            </div>
            <div class="p-2 bd-highlight">
                <a class="text-decoration-none flex-1 link" href="' . $this->liga($row['id'], $row['estado']) . '">
                    <h5>' . $row['cliente'] . '</h5>
                    <p class="text-700 fw-semi-bold fs--1 mb-0 lh-sm line-clamp-1">' . $row['nombre'] . '</p>
                </a>
            </div>
            <div class="ms-auto p-2 bd-highlight">' . $fechaInicio . '</div>
            ';
            $aux .= "</div>";
        }


        return $aux;
    }

    function conteo($id , $user)
    {
        $sql = "select count(id) as conteo from visita where estado = '" . $id . "' and usuario ='" . $user . "'";
        $result = $this->conn->select($sql);
        while ($row = $result->fetch_assoc()) {
            $cont = $row["conteo"];
        }

        return $cont;
    }

    function validarEstado($llave)
    {
        $sql = "select estado from visita where id = '" . $llave . "'";
        $result = $this->conn->select($sql);
        $estado = -1;
        while ($row = $result->fetch_assoc()) {
            $estado = $row["estado"];
        }

        return $estado;
    }
    function datosVisita($llave)
    {
        $sql = "select conclusiones,compromiso  from visita where id = '" . $llave . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
        $estado = -1;
        $obj = new stdClass();

        $obj->conclusiones = "";
        $obj->compromiso = "";

        while ($row = $result->fetch_assoc()) {
            $obj->conclusiones = $row["conclusiones"];
            $obj->compromiso = $row["compromiso"];
        }

        return $obj;
    }

    function datos($clave)
    {
        $sql = "select * from visita where id = '" . $clave . "'";
        $result = $this->conn->select($sql);

        //echo $sql;
        $obj = new stdClass();
        $obj->razon  = "";
        $obj->puesto = "";
        $obj->correo = "";
        $obj->nom    = "";

        while ($row = $result->fetch_assoc()) {
            $obj->razon = $row["cliente"];
            $obj->puesto = $row["puesto"];
            $obj->correo = $row["correo"];
            $obj->nom = $row["nombre"];
        }

        return $obj;
    }

    function antes($id, $estado)
    {
        if ($estado == 0) {
            return "registroedit.php?id=" . $id . "&estado=" . $estado;
        } else if ($estado == 1) {
            return "procesoedit.php?id=" . $id . "&estado=" . $estado;
        } else if ($estado == 2) {
            return "compromisoedit.php?id=" . $id . "&estado=" . $estado;
        }
    }

    function datoscom($clave)
    {
        $sql = "SELECT * FROM visita WHERE id = '" . $clave . "'";
        $result = $this->conn->select($sql);

        //echo "<br>sql = " . $sql;
        $obj = new stdClass();
        $obj->razon  = "";
        $obj->puesto = "";
        $obj->correo = "";
        $obj->nom    = "";
        $obj->objetivo    = "";
        $obj->descrip = "";
        $obj->fecha = "";
        $obj->usuario = "";
        $obj->conclusiones = "";
        $obj->compromiso = "";
        $obj->conjunto = "";

        while ($row = $result->fetch_assoc()) {
            $obj->razon = $row["cliente"];
            $obj->puesto = $row["puesto"];
            $obj->correo = $row["correo"];
            $obj->nom = $row["nombre"];
            $obj->objetivo = $row["objetivo"];
            $obj->descrip = $row["descrip"];
            $obj->fecha = $row["fecha"];
            $obj->conclusiones = $row["conclusiones"];
            $obj->compromiso = $row["compromiso"];
            $obj->usuario = $row["usuario"];
            $obj->conjunto = $row["conjunto"];
        }

        return $obj;
    }

    public function updateReg($id, $cliente, $puesto, $correo, $nombre, $objetivo, $descrip, $llave , $conjunto)
    {
        $sql = "UPDATE visita SET cliente= '" . $cliente . "', puesto = '" . $puesto . "', correo = '" . $correo . "', nombre = '" . $nombre . "', objetivo = '" . $objetivo . "' ,  descrip = '" . $descrip . "', conjunto= '" . $conjunto . "' ,fechalog = now() , estado=1 WHERE visita.id = '" . $llave . "'";

        //echo $sql;
        $result = $this->conn->select($sql);

        return "proceso.php?tipo=101&clave=" . $llave . "&ran=" . rand();
    }

    public function updatePro($id, $desc, $compromiso)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaNow = date("Y-m-d H:i:s");
        $sql = "UPDATE visita SET conclusiones ='" . $desc . "' , compromiso ='" . $compromiso . "',fechalog = '" . $fechaNow . "' ,estado=2 WHERE id = '" . $id . "'";

        //echo $sql;
        $result = $this->conn->select($sql);

        return "compromiso.php?id=" . $id;
    }
}
