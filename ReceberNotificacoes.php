<?php

$json = file_get_contents('php://input');

$obj = json_decode($json);
$tipoEvento = $obj->{'event'};


http_response_code(200);


?>