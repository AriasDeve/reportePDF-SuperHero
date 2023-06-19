<div class="mb-3">
    <h2 class="text-lg"><?= $titulo ?></h2>
    <hr>
    <p>Generado desde backend</p>
</div>

<div>
    <?php

        function crearTabla($casa = ""){
            $nuevaTabla = "
            <h4>{$casa}</h4>
            <table class='table table-border mb-3'>
                <colgroup>
                    <col style='width: 10%;'>
                    <col style='width: 25%;'>
                    <col style='width: 30%;'>
                    <col style='width: 20%;'>
                    <col style='width: 15%;'>
                </colgroup>
                <thead>
                    <tr class='bg-info'>
                        <th>ID</th>
                        <th>Nick</th>
                        <th>Nombre</th>
                        <th>Alineación</th>
                        <th>Altura</th>
                    </tr>
                </thead>
                <tbody>
            ";
        echo  $nuevaTabla;
        }

        function cerrarTabla(){
            $cerrarTabla = "
            </tbody>
            </table>
            ";
        echo $cerrarTabla;
        }

        function agregarFila($arreglo = []){
            echo "
                <tr>
                    <td>{$arreglo['id']}</td>
                    <td>{$arreglo['superhero_name']}</td>
                    <td>{$arreglo['full_name']}</td>
                    <td>{$arreglo['alignment']}</td>
                    <td>{$arreglo['height_cm']}</td>
                </tr>
            ";
        }
        // ----------------------------------------------
        function crearTablaReport($registrosPorCasa){
            $nuevaTablaReport = "
            <h3 class='mt-3'>Número de registros por casa editorial:</h3>
            <table class='table table-border mb-3'>
                <colgroup>
                    <col style='width: 15%;'>
                    <col style='width: 15%;'>
                </colgroup>
                <thead>
                    <tr class='bg-success'>
                        <th>Casa Editorial</th>
                        <th>Numero de Registros</th>
                    </tr>
                </thead>
                <tbody>
            ";

            foreach ($registrosPorCasa as $casa => $numRegistros) {
                echo "
                <tr>
                    <td>{$casa}</td>
                    <td>{$numRegistros}</td>
                </tr>";
            }

        echo  $nuevaTablaReport;
        }

        function cerrarTablaReport(){
            $cerrarTablaReport = "
            </tbody>
            </table>
            ";
        echo $cerrarTablaReport;
        }
        // ----------------------------------------------

        function reportPublisher($registrosPorCasa) {
            echo "<h3 class='mt-3'>Número de registros por casa editorial:</h3>";
            echo "<ul>";
            foreach ($registrosPorCasa as $casa => $numRegistros) {
                echo "<li>{$casa}: {$numRegistros} registros</li>";
            }
            echo "</ul>";
        }

        if (count($datos) > 0){
            $casaActual = $datos[0]["publisher_name"];
            $registrosPorCasa = array($casaActual => 0);
            crearTabla($casaActual);
            foreach($datos as $registro){
                if($casaActual == $registro["publisher_name"]){
                    agregarFila($registro);
                    $registrosPorCasa[$casaActual]++;
                }else{
                    $casaActual = $registro["publisher_name"];
                    cerrarTabla();
                    crearTabla($casaActual);
                    agregarFila($registro);
                    $registrosPorCasa[$casaActual] = 1;
                }
            }
            cerrarTabla();
            // Llamamos las funciones
            reportPublisher($registrosPorCasa);
        }else{
            echo "<h3 class='mt-3'>No encontramos registros</h3>";
        }
    ?>
</div>