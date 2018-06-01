<?php
require_once 'Seguranca.php';
require_once 'FunctionsCustomer.php';
require_once 'FunctionsOrder.php';
require_once 'FunctionsPayment.php';


$seg = new Seguranca();

$nome = $seg->filtro($_POST['firstName']).' '.$seg->filtro($_POST['lastName']);
$first = $seg->filtro($_POST['firstName']);
$last = $seg->filtro($_POST['lastName']);
$tipoDocumento = $seg->filtro($_POST['tipoDocumento']);
$cpf = '';
$cnpj = '';
if ($tipoDocumento == 'CPF') {
    $cpf =  $seg->filtro($_POST['CPF']);
}

if ($tipoDocumento == 'CNPJ') {
    $cnpj = $seg->filtro($_POST['CNPJ']);
}


$email = $seg->filtro($_POST['email']);
$birthDate = $seg->filtro($_POST['dia']).$seg->filtro($_POST['mes']).$seg->filtro($_POST['ano']);
$birthDate = date("Y-m-d", strtotime($birthDate));
$phoneDDI = $seg->filtro($_POST['DDI']);
$phoneDDD = $seg->filtro($_POST['DDD']);
$phone = $seg->filtro($_POST['number']);
$rua =  $seg->filtro($_POST['rua']);
$ruaNumero =  $seg->filtro($_POST['ruaNumero']);
$complemento =  $seg->filtro($_POST['complemento']);
if ($complemento == null) {
    $complemento = '';
}
$bairro =  $seg->filtro($_POST['bairro']);
$cep =  $seg->filtro($_POST['cep']);
$cidade =  $seg->filtro($_POST['cidade']);
$estado =  $seg->filtro($_POST['estado']);
$pais =  $seg->filtro($_POST['pais']);
$hash = $seg->filtro($_POST['hash']);
$preco = $seg->filtro($_POST['preco']);
$parcelas = $seg->filtro($_POST['numParcelas']);
$tipoPagamento = $seg->filtro($_POST['tipoPagamento']);

if ($parcelas == null) {
    $parcelas = 1;
}

$custumer = new FunctionsCustomer();
$idCustumer = '';
if ($tipoDocumento == 'CPF') {
   $idCustumer = $custumer->createCustomer($cpf,$first,$last,$email,$birthDate,$tipoDocumento,$cpf,$phoneDDI,$phoneDDD,$phone,$rua,$ruaNumero,$complemento,$bairro,$cep,$cidade,$estado,$pais);
}

if ($tipoDocumento == 'CNPJ') {
    $idCustumer =  $custumer->createCustomer($cnpj,$first,$last,$email,$birthDate,$tipoDocumento,$cnpj,$phoneDDI,$phoneDDD,$phone,$rua,$ruaNumero,$complemento,$bairro,$cep,$cidade,$estado,$pais);
}

$idPedido = '';
$descProduto= '';
// https://dev.moip.com.br/v2.0/reference#categorias-de-produtos-1
$category = '';
$quant = 1;

$order = new FunctionsOrder();
$idOrder = '';

$emailDestino = '';

if ($tipoDocumento == 'CPF') 
$idOrder = $order->createOrder($cpf,$idCustumer,$descProduto,$category,$quant,$preco,$emailDestino);

if ($tipoDocumento == 'CNPJ')
$idOrder = $order->createOrder($cpf,$idCustumer,$descProduto,$category,$quant,$preco,$emailDestino);


$pay = new FunctionsPayment();

$descPay = '';
$idPayment = '';
$expDate = date('Y-m-d',strtotime($expDate. ' + 3 days'));
if (date('n',strtotime($expDate)) == 6) {
    $expDate = date('Y-m-d', strtotime($expDate. ' + 2 days'));
}
if (date('n',strtotime($expDate)) == 7) {
    $expDate = date('Y-m-d', strtotime($expDate. ' + 1 days'));
}

$instructionFirst = '';
$instructionSecond = '';
$instructionThird = '';
$logoUrl = '';

if ($tipoPagamento == 'CREDIT_CARD') {

    if ($tipoDocumento == 'CPF') 
        $idPayment = $pay->createPaymentCreditCard($idOrder,$parcelas,$descPay,$hash,$nome,$birthDate,$tipoDocumento,$cpf,$phoneDDI,$phoneDDD,$phone,$cidade,$bairro,$rua,$ruaNumero,$cep,$estado);

    if ($tipoDocumento == 'CNPJ')
        $idPayment = $pay->createPaymentCreditCard($idOrder,$parcelas,$descPay,$hash,$nome,$birthDate,$tipoDocumento,$cpf,$phoneDDI,$phoneDDD,$phone,$cidade,$bairro,$rua,$ruaNumero,$cep,$estado);
}

if ($tipoPagamento == 'BOLETO') {
    $idPayment = $pay->createPaymentBoleto($idOrder,$descPay,$expDate,$instructionFirst,$instructionSecond,$instructionThird,$logoURL);
}

$url = '';
header('location:'.$url);





?>