<?php

require_once 'Conexion.php';

$resp = ejecutarConsulta("INSERT INTO categoria(nombre, descripcion, condicion) 
VALUES ('MEDICAMENTOS','medicina',1)");
echo $resp;
