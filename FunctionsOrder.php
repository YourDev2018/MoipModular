<?php
require_once 'BasicAuth.php';
class FunctionsOrder 
{
    
    public function createOrder($id,$idMoipClient, $product, $category, $quantidade,$preco,$detail){
        // sobre a categoria .. https://dev.moip.com.br/v2.0/reference#categorias-de-produtos
        // https://dev.moip.com.br/v2.0/reference#criar-pedido-2

        $curl = curl_init();
        $oAuth = new BasicAuth();
        $url = "https://sandbox.moip.com.br/v2/orders";


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
                \"ownId\": \"$id\",
                \"amount\": {
                \"currency\": \"BRL\",
                \"subtotals\": {
                    \"shipping\": 0
                }
                },
                \"items\": [
                {
                    \"product\": \"$product\",
                    \"category\": \"$category\",
                    \"quantity\": \"$quantidade\",
                    \"detail\":\"$detail\",
                    \"price\": $preco
                }
                ],
                \"customer\": {
                \"id\": \"$idMoipClient\"              
                }
            } ",

            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$oAuth->getBasicAuth(),
                "Content-Type: application/json"
            )
            ));

            $resposta = curl_exec($curl);
            $obj = json_decode($resposta);
            $id = $obj->{'id'};
            return $id;
            

    }

    public function getInfoOrder($orderId){
            
        $curl = curl_init();
        $url = "https://sandbox.moip.com.br/v2/orders/$orderId";
       // $token_Acess = getToken();    
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
        return $resposta;

    }
    
    

}


?>