<?php
require_once "BasicAuth.php";
require_once "FunctionsNotifications.php";
require_once "FunctionsOrder.php";
require_once "FunctionsCustomer.php";

$notifications = new FunctionsNotifications();
$notifications-> setPrerenciaNotificacao();

//$notifications->listarPreferenciaNotificacao();
//$notifications->deletePrerenciaNotificacao("NPR-PFLU6YGZ0GYW");

//$custumer = new FunctionsCustomer();
//$idCustumer = $custumer->createCustomer('17084104738','Guilherme','Morgado','morg.guilherme@gmail.com','1998-12-04','CPF','17084104739','55','21','21472261','bluemanu','241','','cascadura','21311120','Rio de Janeiro','RJ','55');


//$order = new FunctionsOrder();
//$order->createOrder('ORD-17084104739',$idCustumer,'Pacote Early Stage 1','BUSINESS_AND_INDUSTRIAL','1','100000','FCM-ADVOGADOS');


?>