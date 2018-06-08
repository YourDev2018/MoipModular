<?php
require_once 'BasicAuth.php';
class FunctionsNotifications 
{
    
    function listarPreferenciaNotificacao(){

        $curl = curl_init();
        $url = "https://sandbox.moip.com.br/v2/preferences/notifications";
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
        print $resposta;

    }

    function getPreferenciaNotificacao($notification_id){

        $curl = curl_init();
        $url = " https://sandbox.moip.com.br/v2/preferences/notifications/$notification_id";
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
        print $resposta;

    }

    function setPrerenciaNotificacao(){
        $curl = curl_init();
        $url = "https://sandbox.moip.com.br/v2/preferences/notifications";

        $oAuth = new BasicAuth();
        $aux = $oAuth->getBasicAuth();

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
            \"events\": [
                \"ORDER.WAITING\",
                \"ORDER.PAID\",
                \"PAYMENT.SETTLED\",
                \"PAYMENT.AUTHORIZED\"
                
            ],
            \"target\": \"http://redirect-moip-com-br.umbler.net/earlyStage/ReceberNotificacoes.php\",
            \"media\": \"WEBHOOK\"
            } 
            
            "
           ,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $aux",
                "Content-Type: application/json"
            )
            ));
            
            $resposta = curl_exec($curl);
            print $resposta;
    }

    function getWebHook($resourceId){
    
         $curl = curl_init();
         $url = "https://sandbox.moip.com.br/v2/webhooks?resourceId=$resourceId";
         $oAuth = new BasicAuth();
       
       // $token_Acess = getToken();

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

    function deletePrerenciaNotificacao($notification_id){

          $url = "https://sandbox.moip.com.br/v2/preferences/notifications/$notification_id";
            $curl = curl_init();
            $oAuth = new BasicAuth();

         curl_setopt_array($curl,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
               "Authorization: Basic ".$oAuth->getBasicAuth(),
                
            ),
            ));

        $resposta = curl_exec($curl);
        print $resposta;

    }

   

}


?>