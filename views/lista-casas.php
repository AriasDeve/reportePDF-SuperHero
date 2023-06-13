<!doctype html>
<html lang="es">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <!-- Cabecera -->
        <div class="row mt-3">
            <h3>Super heróes - casa distribuidora</h3>
            <p>Reporte en formato PDF</p>
        </div>
        <!-- Filtro -->
        <div class="row">
            <div class="col-md-12">
                <!-- Inicio Card -->
                <div class="card">
                    <div class="card-header">Filtro de casas</div>
                    <!-- Inicio body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <select name="casas" id="casas" class="form-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid">
                                    <button class="btn btn-success" id="generarpdf">
                                        Generar PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin body -->
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
                <!-- Fin Card -->
            </div>
        </div>
        <!-- Datos - tabla -->
        <div class="row mt-3">
            <div class="col-md-12">
                <table id="table-superhero" class="table table-sm table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="30%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nick</th>
                            <th>Nombre</th>
                            <th>Color Ojos</th>
                            <th>Color Cabello</th>
                            <th>Color Piel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Asíncrono -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const selectCasas = document.querySelector("#casas");
        const tabla = document.querySelector("#table-superhero tbody");

        function getPublishers(){
            fetch(`../controllers/publisher.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos => {
                datos.forEach(element=>{
                    const optionTag = document.createElement("option");
                    optionTag.value = element.id;
                    optionTag.text = element.publisher_name;
                    selectCasas.appendChild(optionTag);
                });
            });
        }

        //Obtiene lista de SuperHero por Publisher
        function getByPublishers(){
            //console.log(selectCasas.value);
            const parametros = new URLSearchParams();
            parametros.append("operacion", "listarCasas");
            parametros.append("publisher_id", parseInt(selectCasas.value));

            fetch(`../controllers/superhero.php?${parametros}`)
            .then(respuesta => respuesta.json())
            .then(datos =>{
                tabla.innerHTML = ``;
                datos.forEach(element =>{
                    const tableRow = `
                    <tr>
                        <td>${element.id}</td>
                        <td>${element.superhero_name}</td>
                        <td>${element.full_name}</td>
                        <td>${element.eye_color}</td>
                        <td>${element.hair_color}</td>
                        <td>${element.skin_color}</td>
                    </tr>
                    `;
                    tabla.innerHTML += tableRow;
                })
            });
        }

        //Eventos
        selectCasas.addEventListener("change", getByPublishers);

        //Cuando el elemento este listo se ejecuta
        getPublishers();
    });
    </script>

</body>

</html>