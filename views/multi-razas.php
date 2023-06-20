
<!doctype html>
<html lang="es">

<head>
    <title>Razas Multiples Listas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            <div class="col-md-12">
                                <div class="row tex-center">
                                    <select name="raza" id="raza" class="form-select" multiple=""multiple>
                                        <option value="">Seleccione..</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin body -->
                    <div class="card-footer text-muted text-center">
                        <button type="button" class="btn btn-success mt-2" id="obtener">Obtener ID</button>
                        <button type="button" class="btn btn-primary mt-2" id="generar">Generar PDF</button>
                    </div>
                </div>
                <!-- Fin Card -->
            </div>
        </div>
        <!-- Datos - tabla -->
        <div class="row mt-3">
            <div class="col-md-12">
                <table id="multiselect" class="table table-sm table-striped">
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
    <!-- CDN JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- CDN Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


   <script>
   document.addEventListener("DOMContentLoaded", () => {
    const listRazas = document.querySelector("#raza");
    const btObtener = document.querySelector("#obtener");

    function obtenerRazas(){
        fetch(`../controllers/race.php?operacion=listar`)
                .then(respuesta => respuesta.json())
                .then(datos =>{
                    datos.forEach(element =>{
                        const tagOption = document.createElement("option");
                        tagOption.value = element.id;
                        tagOption.text = element.race;
                        listRazas.appendChild(tagOption);
                    });
                });
    }

    function getRazas(strActivos){
        const parametros = new URLSearchParams();
        parametros.append("operacion","getRazas");
        parametros.append("race_ids",strActivos);

        fetch(`../controllers/multi-razas.php?${parametros}`)
            .then(respuesta => respuesta.json())
            .then(datos => {
                tableRazas.innerHTML = ``;
                datos.forEach(element => {
                    const tableRow = `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.superhero_name}</td>
                            <td>${element.full_name}</td>
                            <td>${element.race}</td>
                        </tr>
                    `;
                    tableRazas.innerHTML +=  tableRow;
                });
            });
    }


    btObtener.addEventListener("click",() => {
        //Arreglo que almacenará los ID
        let strActivos = "";

        //Recorrer todas las opcionbes y verificar cuáles fueron seleccionadas
        for( let option of document.querySelector("#raza").options){
          if(option.selected){
            strActivos += `${option.value},`;
          }
        }
        getRazas(strActivos);
    });


    //Método inicializador (control SELECT)
    $("#raza").select2();

    obtenerRazas();
   });

   </script>

</body>

</html>