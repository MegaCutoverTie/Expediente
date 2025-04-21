<?php
class colaborador
{
    public $conn;

    public function __construct()
    {
        $this->conn = new sql();
    }

    public function llave()
    {
        $sql = "SELECT max(id)max FROM colaborador";
        $max= 1;
        $result = $this->conn->select($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc())
            {
                $max=$row["max"];
            }
        }
        $max++;
        return $max;
    }

    public function crear($nom, $app, $apm , $tel, $correo, $aux ,$fecha, $auxtel, $foto)
    {
        $id = $this->llave();

        $sql = "insert into colaborador (id, nom, app, apm, tel, correo, aux, fecha, auxtel, foto) values ('" . $id . "','" . $nom . "','" . $app . "','" . $apm . "','" . $tel . "','" . $correo . "','" . $aux . "','" . $fecha . "','" . $auxtel . "','" . $foto . "')";

        //echo $sql."\n\n";
        $result = $this->conn->select($sql);
        $this->llenarExpediente($id);
    }

    public function llenarExpediente($id)
    {
        $sql = "insert into historico (id_exp, descri, id_expediente) select id, descri, '" . $id."' from plantilla";
        //echo $sql;
        $result = $this->conn->select($sql);
    }

    public function tabla()
    {
        $sql="select id, nom, app, apm , tel, correo, aux ,fecha, auxtel from colaborador where activo = 1";
        $result = $this->conn->select($sql);

        $line = '<table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">Documento</th>
                <th scope="col"></th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col" class="text-center"><img src="img/person.svg" alt=""></th>
                <th scope="col" class="text-center"><img src="img/edit.svg" alt=""></th>
                <th scope="col" class="text-center"><img src="img/delete.svg" alt=""></th>
            </tr>
        </thead>
        <tbody>'; 
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc())
            {
                $line .= '
                        <tr>
                            <td>' . $row["id"] . '</td>
                            <td>' . $row["nom"] . '</td>
                            <td>' . $row["app"] . '</td>
                            <td>' . $row["apm"] . '</td>
                            <td class="text-center"><button class="btn btn-dark btn-sm" onclick="view(\'' . $row["id"] . '\')"><img src="img/person2.svg" alt=""></button></td>
                            <td class="text-center"><button class="btn btn-primary btn-sm" onclick="edit(\'' . $row["id"] . '\')"><img src="img/edit2.svg" alt=""></button></td>
                            <td class="text-center"><button class="btn btn-danger btn-sm" onclick="del(\'' . $row["id"] . '\')"><img src="img/delete2.svg" alt=""></button></td>
                        </tr>'; 
            }
        }

        $line .= '</tbody></table>'; 
        return $line;
    }

    function modificarPlantilla($id)
    {
        $sql = "select * from colaborador where id = '" . $id . "'";
        $result = $this->conn->select($sql);

        $nom = "";
        $app = "";
        $apm = "";
        $tel = "";
        $correo = "";
        $aux = "";
        $fecha = "";
        $auxtel = "";
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row["nom"];
                $app = $row["app"];
                $apm = $row["apm"];
                $tel = $row["tel"];
                $correo = $row["correo"];
                $aux = $row["aux"];
                $fecha = $row["fecha"];
                $auxtel = $row["auxtel"];
            }
        }

        $aux1 = '
        <div class="col-6">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="' . $id . '">
                <label for="nom" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="' . $nom . '">
            </div>
            <div class="mb-3">
                <label for="app" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="app" name="app" value="' . $app . '">
            </div>
            <div class="mb-3">
                <label for="apm" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="apm" name="apm" value="' . $apm . '">
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Telefono:</label>
                <input type="text" class="form-control" id="tel" name="tel" value="' . $tel . '">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Nacimineto:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="' . $fecha . '">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="nomc" class="form-label">Nombre Contacto:</label>
                <input type="text" class="form-control" id="nomc" name="nomc" value="' . $aux . '">
            </div>
            <div class="mb-3">
                <label for="telc" class="form-label">Telefono Contacto:</label>
                <input type="text" class="form-control" id="telc" name="auxtel" value="' . $auxtel . '">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" value="' . $correo . '">
            </div>
        </div>';
        return $aux1;
    }

    function modificar($id, $nom, $app, $apm , $tel, $correo, $aux ,$fecha, $auxtel)
    {
        $sql = "update colaborador set nom= '" . $nom . "', app = '" . $app . "', apm = '" . $apm . "', tel = '" . $tel . "', correo = '" . $correo . "', aux = '" . $aux . "', fecha = '" . $fecha . "', auxtel = '" . $auxtel . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
    }

    function eliminarPlantilla($id)
    {
        $aux1 = '
        <div>
            <input type="hidden" class="form-control" id="id" name="id" value="' . $id . '">
            <p>¿Esta seguro que desea eliminar el Colaborador?</p> 
        </div>';
        return $aux1;
    }

    function eliminar($id, $activo)
    {
        $sql = "update colaborador set activo= '" . $activo . "' where id = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);
    }

    function mostrar($id)
    {
        $sql = "select * from colaborador where id = '" . $id . "'";
        $result = $this->conn->select($sql);

        $nom = "";
        $app = "";
        $apm = "";
        $tel = "";
        $correo = "";
        $aux = "";
        $auxtel = "";
        $foto = "";
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nom = $row["nom"];
                $app = $row["app"];
                $apm = $row["apm"];
                $tel = $row["tel"];
                $correo = $row["correo"];
                $aux = $row["aux"];
                $auxtel = $row["auxtel"];
                $foto = $row["foto"];
            }
        }

        $aux1 = '
        <div>
            <div class="text-center mt-3 mb-3">
                <img src="' . $foto . '" style="width:100px;border-radius: 50%;">
            </div>
            <div class="text-white">
                <h3 class="text-center">' . $nom . ' ' . $app . ' ' . $apm . ' </h3>
                <h4>Información personal</h4>
                <p>Telefono: ' . $tel . ' </p>
                <p>Correo: ' . $correo . ' </p>
                <h4>LLamar en caso de emergencia</h4>
                <p>Nombre: ' . $aux . ' </p>
                <p>Telefono: ' . $auxtel . ' </p>
            </div>
            <button class="btn btn-warning btn-sm position-absolute bottom-0 start-0 m-3" onclick="pageReturn()"><img src="img/return.svg" alt=""></button>
        </div>';
        //echo $id;
        return $aux1;
    }

    public function expediente($id)
    {
        $sql = "select * from historico where id_expediente = '" . $id . "'";
        //echo $sql;
        $result = $this->conn->select($sql);

        $line = '<table class="table mt-3">
        <thead>
        <tbody>'; 
 
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc())
            {
                if($row["doc"] != NULL)
                {
                    $line .= '
                    <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                        <div class="me-auto">
                            ' . $row["descri"] . '
                        </div>
                        <span class="badge">
                            <button hidden class="btn btn-danger btn-sm" onclick="delDoc(\'' . $row["id"] . '\')"><img src="img/delete2.svg" alt=""></button>
                            <input type="hidden" class="form-control" id="id" name="id" value="' . $id . '">
                            <input type="file" hidden class="form-control" id="fileUp" name="id">
                            <button class="'. 'btn btn-danger btn-sm' .'" onclick="openDoc(\'' . $row["doc"] . '\')"><img src="'. 'img/description.svg' .'" alt=""></button>
                        </span>
                    </li>
                    '; 
                }
                else
                {
                    $line .= '
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                        ' . $row["descri"] . '
                    </div>
                    <span class="badge">
                        <input type="hidden" class="form-control" id="id" name="id" value="' . $id . '">
                        <button class="'.'btn btn-primary btn-sm' .'" onclick="sendDoc(\'' . $row["id"] . '\')"><img src="'. 'img/cloud.svg'.'" alt=""></button>
                    </span>
                </li>
                '; 
                }
                
            }
        }

        return $line;
    }

public function subirDoc($id, $doc, $fecha)
{
    $sql = "update historico set doc = '" . $doc . "', fecha = '" . $fecha . "' WHERE id = '" . $id . "'";
    $result = $this->conn->select($sql);
}

public function eliminarDoc($id)
{
    $sql = "select doc from historico WHERE id = '".$id."'";
    //echo $sql;
    $result = $this->conn->select($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row["doc"];
        
        if(file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    $sql ="update historico set doc = NULL, fecha = NULL WHERE id = '".$id."'";
    //echo $sql;
    $result = $this->conn->select($sql);
}
}