<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head> 

<body>
    <div class="container"> 
        <div class="row shadow-lg mb-5 bg-body-tertiary rounded mt-3">
            <div class="col-12 mt-3 mb-3 row justify-content-between">
                <h5 class="col-4 ">Agregar Nuevo Colaborador</h5>
                <button type="button" class="col-1 btn btn-primary" id="bntadd" onclick="add()"><img src="img/add.svg" alt="">
            </div>
        </div>
        <div class="row shadow-lg mb-5 bg-body-tertiary rounded bg-white">
            <div class="col-md-12" id="reload">

            </div>
        </div>
    </div>
    <div class="modal" id="modalAdd">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title">Crear Colaborador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crearColab" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="id1">
                                    <label for="nom1" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nom1" name="nom1">
                                </div>
                                <div class="mb-3">
                                    <label for="app1" class="form-label">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="app1" name="app1">
                                </div>
                                <div class="mb-3">
                                    <label for="apm1" class="form-label">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="apm1" name="apm1">
                                </div>
                                <div class="mb-3">
                                    <label for="tel1" class="form-label">Telefono:</label>
                                    <input type="text" class="form-control" id="tel1" name="tel1">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha1" class="form-label">Fecha de Nacimineto:</label>
                                    <input type="date" class="form-control" id="fecha1" name="fecha1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nomc1" class="form-label">Nombre Contacto:</label>
                                    <input type="text" class="form-control" id="nomc1" name="nomc1">
                                </div>
                                <div class="mb-3">
                                    <label for="telc1" class="form-label">Telefono Contacto:</label>
                                    <input type="text" class="form-control" id="telc1" name="telc1">
                                </div>
                                <div class="mb-3">
                                    <label for="correo1" class="form-label">Correo:</label>
                                    <input type="text" class="form-control" id="correo1" name="correo1">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"  onClick="enviar()">Crear</button>
                </div>
            </div>
        </div>
    </div> 
    <div class="modal" id="modalWrite">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modificar Colaborador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modifColab" enctype="multipart/form-data">
                    <div class="modal-body" id="modalText">
                        
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardar()">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalDel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Colaborador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalDelete">
                    <p>¿Esta seguro que desea eliminar el Colaborador?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onClick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        (function(){
            load();
        })();

        function load() {
            $.post("procesos.php", { tipo: 1 }, function(result) {
                $("#reload").html(result);
            });
        }

        function add()
        {
            $("#modalAdd").modal("show");
        }

        function edit(id) {
            var url = "procesos.php?tipo=3&id=" + id;
            console.log(url);
            $.get(url, function (result) {
                $("#modalText").html(result);
            });
            $("#modalWrite").modal("show");
        }

        function del(id) {
            var url = "procesos.php?tipo=5&id=" + id;
            console.log(url);
            $.get(url, function (result) {
                $("#modalDelete").html(result);
            });
            $("#modalDel").modal("show");
        }

        function view(id) {
            location.href = "Edit.php?tipo=7&id=" + id;
        }

        function enviar(){
            var nom = $("#nom1").val();
            var app = $("#app1").val();
            var apm = $("#apm1").val();
            var tel = $("#tel1").val();
            var correo = $("#correo1").val();
            var aux = $("#nomc1").val();
            var fecha = $("#fecha1").val();
            var auxtel = $("#telc1").val();


            var element = document.getElementById("foto");

            var error = "";

            if (nom == "") {
                error += "falta el nombre\n";
            }
            if (app == "") {
                error += "falta el apellido paterno\n";
            }
            if (apm == "") {
                error += "falta el apellido materno\n";
            }
            if (tel == "") {
                error += "falta el telefono\n";
            }
            if (correo == "") {
                error += "falta el correo\n";
            }
            if (aux == "") {
                error += "falta el nombre del contacto\n";
            }
            if (fecha == "") {
                error += "falta la fecha de nacimiento\n";
            }
            if (auxtel == "") {
                error += "falta el telefono del contacto\n";
            }
            if (element.files.length == 0) {
                error += "falta la foto\n";
            }

            if (error == "") {
                var form = document.getElementById("crearColab");
                var formData = new FormData();

                formData.append("tipo", 2);
                formData.append("nom", nom);
                formData.append("app", app);
                formData.append("apm", apm);
                formData.append("tel", tel);
                formData.append("correo", correo);
                formData.append("aux", aux);
                formData.append("fecha", fecha);
                formData.append("auxtel", auxtel);
                formData.append("foto", element.files[0]);

                var request = new XMLHttpRequest();
                request.open("POST", "procesos.php");
                request.send(formData);
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        alert(this.responseText);
                        load();
                        form.reset();
                    }
                }

                $("#modalAdd").modal("hide");
            }
            else {
                alert(error);
            }
        }

        function guardar(){
            var id = $("#id").val();
            var nom = $("#nom").val();
            var app = $("#app").val();
            var apm = $("#apm").val();
            var tel = $("#tel").val();
            var correo = $("#correo").val();
            var aux = $("#nomc").val();
            var fecha = $("#fecha").val();
            var auxtel = $("#telc").val();

            var error = "";

            if (nom == "") {
                error += "falta el nombre\n";
            }
            if (app == "") {
                error += "falta el apellido paterno\n";
            }
            if (apm == "") {
                error += "falta el apellido materno\n";
            }
            if (tel == "") {
                error += "falta el telefono\n";
            }
            if (correo == "") {
                error += "falta el correo\n";
            }
            if (aux == "") {
                error += "falta el nombre del contacto\n";
            }
            if (fecha == "") {
                error += "falta la fecha de nacimiento\n";
            }
            if (auxtel == "") {
                error += "falta el telefono del contacto\n";
            }

            if (error == "") {
                var form = document.getElementById("modifColab");
                var formData = new FormData();

                formData.append("id", id)
                formData.append("tipo", 4);
                formData.append("nom", nom);
                formData.append("app", app);
                formData.append("apm", apm);
                formData.append("tel", tel);
                formData.append("correo", correo);
                formData.append("aux", aux);
                formData.append("fecha", fecha);
                formData.append("auxtel", auxtel);

                var request = new XMLHttpRequest();
                request.open("POST", "procesos.php");
                request.send(formData);
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        alert(this.responseText);
                        load();
                    }
                }

                $("#modalWrite").modal("hide");
            }
            else {
                alert(error);
            }
        }

        function eliminar(){
            var id = $("#id").val();
            var form = document.getElementById("modifColab");
            var formData = new FormData();

            formData.append("id", id)
            formData.append("tipo", 6);

            var request = new XMLHttpRequest();
            request.open("POST", "procesos.php");
            request.send(formData);
            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    alert(this.responseText);
                    load();
                }
            }

            $("#modalDel").modal("hide");
        }
    </script>
</body>

</html>