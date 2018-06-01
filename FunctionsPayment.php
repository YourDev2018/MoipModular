<?php
require_once 'BasicAuth.php';
class FunctionsPayment 
{

    public function createPaymentCreditCard($orderID,$numinstallments,$descPayment,$hash,$nomePortador,$nascimentoPortador,
                                            $typeDocument,$numberDocument,$DDI,$DDD,$number, $cidade,$bairro,$rua,$numero,$cep,$estado){

        // data de nascimento (AAAA-MM-DD)

        $url = "https://sandbox.moip.com.br/v2/orders/".$orderID."/payments";
        
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
                \"installmentCount\":\"$numinstallments\",
                \"statementDescriptor\":\"$descPayment\",
                \"fundingInstrument\":{  
                \"method\":\"CREDIT_CARD\", 
                \"creditCard\":{  
                    \"hash\": \"$hash\",
                    \"store\":false,
                    \"holder\":{  
                        \"fullname\":\"$nomePortador\",
                        \"birthdate\":\"$nascimentoPortador\",
                         \"taxDocument\": {
                            \"type\": \"$typeDocument\",
                            \"number\": \"$numberDocument\"
                        },
                        \"phone\":{  
                            \"countryCode\":\"$DDI\",
                            \"areaCode\":\"$DDD\",
                            \"number\":\"$number\"
                        },

                        \"billingAddress\":{  
                            \"city\":\"$cidade\",
                            \"district\":\"$bairro\",
                            \"street\":\"$rua\",
                            \"streetNumber\":\"$numero\",
                            \"zipCode\":\"$cep\",
                            \"state\":\"$estado\",
                            \"country\":\"BRA\"
                        }
                    }
                }
                }
            }
            ",
            

            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$oAuth->getBasicAuth(),
                "Content-Type: application/json"
            ),
            ));

            $resposta = curl_exec($curl);
            print $resposta;

    }

    function createPaymentBoleto($orderID,$desc,$expirationDate,$instructionFirst,$instructionSecond,$instructionThird,$logoUrl){

        // https://dev.moip.com.br/v2.0/reference#exemplos-pagamento


        $oAuth = new BasicAuth();

        $url = "https://sandbox.moip.com.br/v2/orders/$orderID/payments";

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
                \"statementDescriptor\":\"$desc\",
                \"fundingInstrument\":{  
                \"method\":\"BOLETO\",
                \"boleto\":{  
                    \"expirationDate\":\"$expirationDate\",
                    \"instructionLines\":{  
                        \"first\":\"$instructionFirst,\",
                        \"second\":\"$instructionSecond\",
                        \"third\":\"$instructionThird\"
                    },
                    \"logoUri\":\"$logoUrl\"
                }
                }
            }
            ",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$oAuth->getBasicAuth(),
                "Content-Type: application/json"
            )
            ));

            $resposta = curl_exec($curl);
            print $resposta;
    }

    function getInfoPagamento($payment_id){

        $curl = curl_init();
        $url = "https://sandbox.moip.com.br/v2/payments/$payment_id";
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