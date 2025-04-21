<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <div class="container" >
        <div class="row shadow-lg mb-5 bg-body-tertiary rounded">
            <div class="col-4 rounded-start" style="background-color: #c10000;">
                <div class="text-center mt-3 mb-3">
                <img src="foto/foto.jpg" style="width:100px;border-radius: 50%;">
                </div>
                <div class="text-white">
                    <h3>Nombre de la persona</h3>
                    <h4>Información personal</h4>
                    <p>Telefono:</p>
                    <p>Correo:</p>
                    <h4>LLamar en caso de emergencia</h4>
                    <p>Nombre:</p>
                    <p>Telefono:</p>
                </div>
            </div>
            <div class="col-8 rounded-end" style="background-color: white;">
            <ul class="list-group list-group-flush mt-3 mb-3">
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                <div class="me-auto">
                    Numero de seguro social
                </div>
                <span class="badge">
                <input type="file" id="file1" name="file1" accept="image/png, image/jpeg" style="display: hidden;display: none;"/>    
                <button class="btn btn-primary btn-sm" onclick="load('file1')"><img src="img/cloud.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Acta de nacimiento
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    CURP
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Constancia de situación fiscal
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Comprobante de estudios
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Comprobante de domicilio
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    INE
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Cuenta bancaria
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Certificado medico
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
                <li class="list-group-item list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                    Constancia de no antecedentes penales
                    </div>
                    <span class="badge"><button class="btn btn-danger btn-sm"><img src="img/description.svg" alt=""></button></span>
                </li>
            </ul>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function load(name)
        {
            $("#"+ name).click();
        }
    </script>
</body>
</html>