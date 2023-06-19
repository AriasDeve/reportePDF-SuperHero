
<!doctype html>
<html lang="es">

<head>
    <title>Razas</title>
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
            <h3>Super heróes - Seleccionando varias razas</h3>
        </div>
        <!-- Filtro -->
        <div class="row">
            <div class="col-md-12">
                <!-- Inicio Card -->
                <div class="card">
                    <div class="card-header">Filtro de razas</div>
                    <!-- Inicio body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-5">
                                        <select class="form-select" size="3" aria-label="multiple select example">
                                            <!-- Vacio -->
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-sm">Agregar</button>
                                        <button type="button" class="btn btn-danger btn-sm mt-2">Eliminar</button>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-select" size="3" aria-label="multiple select example">
                                            <!-- Vacio -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid">
                                    <button class="btn btn-info btn-sm mt-4 " id="generarpdf">
                                        PDF
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
                            <th>Raza</th>
                            <th>Alineacion</th>
                            <th>Estructura</th>
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
   </script>

</body>

</html>