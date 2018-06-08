<?php
require_once "EnviarEmail.php";
require_once "FunctionsOrder.php";

$json = file_get_contents('php://input');

//$json = '';

$obj = json_decode($json);
$tipoEvento = $obj->{'event'};


$enviar = new EnviarEmail();
$rementeToFCM = "YourDev Sistemas";
$remente = "FCM Advogados";
$emailClienteYourDev = "contato@fcmlaw.com.br";

// ORDER.WAITING
//PAYMENT.AUTHORIZED
// PAYMENT.SETTLED




if ($tipoEvento == "ORDER.WAITING") {
    
    $order = returnStringOrder($obj);
    $detailPedido = getDetailOrder($obj);
    $produto = getProductOrder($obj);
    $preco = getPriceOrder($obj);
    //

    $assunto = "$produto - Pagamento recebido";
    $nomeCliente = getNomeClienteOrder($obj);
    $destino = getEmailCustumer($obj);

    $corpo = "Olá $nomeCliente, tudo bem? <br>";
    $corpo .= "Vim informar que seu pedido foi recebido e está esperando a confirmação do pagamento <p>";
    $corpo .= "Pedido: $order <br>";
    $corpo .= "Item: $produto <br>";
    $corpo .= "Valor: $preco <br>";

    print $corpo;

    $enviar->enviar($remente,$assunto,$destino,$corpo);

}

if ($tipoEvento == "PAYMENT.AUTHORIZED") {
    
    $order =  returnStringOrderPayment($obj);

    $jsonOrder = getJsonOrder($obj);
    $obj = json_decode($jsonOrder);
   
    
    $detailPedido = getDetailInfoOrder($obj);
    $produto = getProductInfoOrder($obj);
    $preco = floatval( getPriceInfoOrder($obj));
    $preco = $preco / 100;
    
    //
    $assunto = "$produto - Pagamento Autorizado";
    $nomeCliente = getNomeClienteInfoOrder($obj);
    $destino = getEmailInfoCustumer($obj);


    $corpo = "Olá $nomeCliente, tudo bem? <br>";
    $corpo .= "Vim informar que seu pedido foi  Autorizado  <p>";
    $corpo .= "Pedido: $order <br>";
    $corpo .= "Item: $produto <br>";
    $corpo .= "Valor: $preco <br>";

  // print $corpo;

   $enviar->enviar($remente,$assunto,$destino,$corpo);

    $phone = getPhoneInfoOrder($obj);

    $corpo = "Olá $remente, tudo bem? <br> ";
    $corpo .= "Vim informar que seu cliente $nomeCliente teve seu pagamento autorizado no $produto <p>";
    
    $corpo .= "Cliente: $nomeCliente <br>";
    $corpo .= "Email: $destino <br>";
    $corpo .= "Telefone: $phone <br> ";

    $corpo .= "Pedido: $order <br>";
    $corpo .= "Item: $produto <br>";
    $corpo .= "Valor: $preco <br>";

    //print $corpo;

   $enviar->enviar('YourDev Sistemas',$assunto,$emailClienteYourDev,$corpo);

}
/*
if ($tipoEvento = "ORDER.PAID") {
   
   $order =  returnStringOrder($obj);

   $enviar->enviar($remente,$assunto,$destino,$corpo);
}
*/

// Enviar para o FCM
if ($tipoEvento == "PAYMENT.SETTLED") {

    $jsonOrder = getJsonOrder($obj);
    $obj = json_decode($jsonOrder);
   
    
    $detailPedido = getDetailInfoOrder($obj);
    $produto = getProductInfoOrder($obj);
    $preco = floatval( getPriceInfoOrder($obj));
    $preco = $preco / 100;
    
    //
    $assunto = "$produto - Pagamento Autorizado";
    $nomeCliente = getNomeClienteInfoOrder($obj);
    $destino = getEmailInfoCustumer($obj);

    $corpo = "Olá $remente, tudo bem? <br> ";
    $corpo .= "Venho informar mais um pagamento está disponível para saque";
     
    $corpo .= "Cliente: $nomeCliente <br>";
    $corpo .= "Email: $destino <br>";
    $corpo .= "Telefone: $phone <br> ";

    $corpo .= "Pedido: $order <br>";
    $corpo .= "Item: $produto <br>";
    $corpo .= "Valor: $preco <br>";


   $enviar->enviar($remente,$assunto,$destino,$corpo);

   // 
}

//  http://redirect-moip-com-br.umbler.net

http_response_code(200);


function returnStringOrderPayment($obj){
    $resource = $obj->{'resource'};
    $payment = $resource->{'payment'};
    $links = $payment->{'_links'};
    $order = $links->{'order'};
    $idOrder = $order->{'title'};

    return $idOrder;
}

function returnStringOrder($obj){

    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $idOrder= $order->{'id'};

    return $idOrder;
}

function getNomeClienteOrder($obj){

    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $custumer = $order->{'customer'};
    $fullName = $custumer->{'fullname'};

    return $fullName;
}

function getDetailOrder($obj){
    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $items = $order->{'items'};
    $items = $items [0];
    $detail = $items->{'detail'};
    return $detail;
    
}

function getProductOrder($obj){
    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $items = $order->{'items'};
    $items = $items [0];
    $detail = $items->{'product'};
    return $detail;
}

function getPriceOrder($obj){

    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $items = $order->{'items'};
    $items = $items [0];
    $price = $items->{'price'};
    return $price;
}

function getEmailCustumer($obj){
    
    $resource = $obj->{'resource'};
    $order = $resource->{'order'};
    $custumer = $order->{'customer'};
    $email = $custumer->{'email'};

    return $email;
}

function getJsonOrder($obj){

    $orderId = returnStringOrderPayment($obj);
    $funcstionsOrder = new FunctionsOrder();
    $orderJson = $funcstionsOrder->getInfoOrder("ORD-JKYE53XMUDS9");
   return $orderJson;

}

function getDetailInfoORder($obj){

     $items = $obj->{'items'};
    $items = $items [0];
    $detail = $items->{'detail'};
    return $detail;

}

function getNomeClienteInfoOrder($order){


    $custumer = $order->{'customer'};
    $fullName = $custumer->{'fullname'};

    return $fullName;
}


function getProductInfoOrder($order){

    $items = $order->{'items'};
    $items = $items [0];
    $detail = $items->{'product'};
    return $detail;
}

function getPriceInfoOrder($order){


    $items = $order->{'items'};
    $items = $items [0];
    $price = $items->{'price'};
    return $price;
}

function getEmailInfoCustumer($order){
    

    $custumer = $order->{'customer'};
    $email = $custumer->{'email'};

    return $email;
}

function getPhoneInfoOrder($order){

     $custumer = $order->{'customer'};
    $phone = $custumer->{'phone'};
    $ddi = $phone->{'countryCode'};
    $ddd = $phone->{'areaCode'};
    $phone = $phone->{'number'};

    return "+$ddi ($ddd) $phone";

}



?>