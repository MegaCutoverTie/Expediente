<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaborador</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body> 
    <div class="container" >
        <div class="row shadow-lg mb-5 bg-body-tertiary rounded mt-3">
            <div class="col-4 rounded-start position-relative" style="background-color: #c10000; padding-bottom: 60px;" id="mostrarColab">
                
            </div>
            <div class="col-8 rounded-end" style="background-color: white;">
                <ul class="list-group list-group-flush mt-3 mb-3" id="mostrarDocs">

                </ul>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function pageReturn() {
            location.href = "listar.php";
        }

        function getId() {
            const params = new URLSearchParams(window.location.search);
            return params.get("id");
        }

        (function(){
            load();
            load2();
        })();

        function load() {
            const id = getId();
            if (id) {
                $.post("procesos.php", { tipo: 7, id: id }, function(result) {
                    $("#mostrarColab").html(result);
                });
            } else {
                $("#mostrarColab").html("<p class='text-white p-3'>No se encontró el colaborador (ID no especificado).</p>");
            }
        }

        function load2() {
            const id = getId();
            if (id) {
                $.post("procesos.php", { tipo: 8, id: id }, function(result) {
                    $("#mostrarDocs").html(result);
                });
            } else {
                $("#mostrarDocs").html("<p class='text-white p-3'>No se encontró el colaborador (ID no especificado).</p>");
            }
        }

        function sendDoc(id) {
            console.log("Preparando para subir documento con ID:", id);
            
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.hidden = true;
            
            fileInput.onchange = async (e) => {
                const file = e.target.files[0];
                if (!file) return;
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('El archivo es demasiado grande (máximo 5MB)');
                    return;
                }
                
                const formData = new FormData();
                formData.append('tipo', '9');
                formData.append('id', id);
                formData.append('doc', file);
                
                try {
                    const response = await fetch('procesos.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.text();
                    console.log(result);
                    alert(result);
                    load2();
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error al subir el documento');
                }
            };
            
            fileInput.click();
        }

        function openDoc(file)
        {
            window.open(file,  '_blank');
        }

        function delDoc(id) {
            if (confirm("¿Estás seguro de eliminar este documento?")) {
            $.post("procesos.php", { tipo: 10, id: id }, function(result) {
                alert(result);
                load2();
            }).fail(function() {
                alert("Error al eliminar el documento");
            });
    }
        }
    </script>
</body>
</html>