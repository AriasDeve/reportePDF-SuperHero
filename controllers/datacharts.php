<?php

if(isset($_GET['operacion'])){
  if($_GET['operacion'] == 'getdata'){
    $datos = [
      "Arequipa"  =>
        [
          "Dengue"  => 10,
          "Covid"   => 15
        ],

      "Lima"      =>
        [
          "Dengue"  => 20,
          "Covid"   => 25
        ],

      "Chincha"   =>
        [
          "Dengue"  => 40,
          "Covid"   => 50
        ],

      "Ayacucho"  =>
        [
          "Dengue"  => 60,
          "Covid"   => 40
        ]
    ];

    $datosAlt = [
      "Dengue"  =>
        [
          "Arequipa"    => 15,
          "Lima"        => 13,
          "Chincha"     => 34,
          "Ayacucho"    => 23
        ],

      "Covid"  =>
        [
          "Arequipa"    => 24,
          "Lima"        => 65,
          "Chincha"     => 21,
          "Ayacucho"    => 56
        ]
    ];

    $datosMin = [
      "Dengue"  => [4, 23, 33, 12],
      "Covid"  => [4, 23, 33, 12]
    ];
    echo json_encode($datosMin);
  }
}
?>