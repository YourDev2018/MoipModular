<?php
require_once 'BasicAuth.php';


class FunctionsCustomer 
{

    private $oAuth = '';

    public function createCustomer($idClient, $firstName, $lastName, $email, $birthDate, $typeDoc, $numDoc ,$phoneDDI, $phoneDDD, $phoneNumero,
                                    $rua, $ruaNumero, $complemento, $bairro, $cep, $cidade, $estado, $pais){

        // $tipoDocumento pode ser uma CPF OU CNPJ, uma STRING de no MÁXIMO 4 CHARS
        // $NumDoc é o número do respectivo documento seja, CPF OU CNPJ
   
       $url = 'https://sandbox.moip.com.br/v2/customers/' ;          
       
       $name = $firstName.' '.$lastName;
       $oAuth = new BasicAuth();

        $curl = curl_init();
        
        curl_setopt_array($curl,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>

            "
            {
                \"ownId\": \"$idClient\",
                \"fullname\": \"$name\",
                \"email\": \"$email\",
                \"birthDate\": \"$birthDate\",
                \"taxDocument\": {
                    \"type\": \"$typeDoc\",
                    \"number\": \"$numDoc\"
                },
                \"phone\": {
                    \"countryCode\": \"$phoneDDI\",
                    \"areaCode\": \"$phoneDDD\",
                    \"number\": \"$phoneNumero\"
                },
                \"shippingAddress\": {
                    \"city\": \"$cidade\",
                    \"district\": \"$bairro\",
                    \"street\": \"$rua\",
                    \"streetNumber\": \"$ruaNumero\",
                    \"complement\": \"$complemento\",
                    \"zipCode\": \"$cep\",
                    \"state\": \"$estado\",
                    \"country\": \"BRA\"
                }
            }

            "
            ,
            CURLOPT_HTTPHEADER => array(
                "Authorization: BASIC ".$oAuth->getBasicAuth(),
                "Content-Type: application/json"
            )
            ));

            
            $resposta = curl_exec($curl);
            $obj = json_decode($resposta);
            $id = $obj->{'id'};
            return $id;


    }

    public function getInfoCustumer($customer_id){
                 $curl = curl_init();
         $url = "https://sandbox.moip.com.br/v2/customers/$customer_id";
        $oAuth = new BasicAuth();
        
        

        curl_setopt_array($curl,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$oAuth->getBasicAuth(),
                
            ),
            ));

        $resposta = curl_exec($curl);
        print $resposta;

    }
    
}


?>