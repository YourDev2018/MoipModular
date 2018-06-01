<?php

// Tutorial para criar a Autentificação BasicAuth e usa-la posteriormente;

/*
1. Crie uma conta sandbox
2. Acesse sua conta criada https://conta-sandbox.moip.com.br/
3. Para pegar suas chaves de acesso siga o caminho: Minha conta >> Configurações >> Chaves de acesso
4. Esse código é o resultado da combinação de token e chave e é usado como valor basic na autorização. 
    Se sua ferramenta de desenvolvimento não faz criptografia automaticamente você pode fazê-la em sites como o Base64 encode. 
    Para isso basta inserir as chaves (separadas por :) no campo vazio e clicar em ENCODE

5 . Coloque a chave em basicAuth e chame apenas a funçao getBasicAuth

Nk5SSkRTWlFRQjFZQVJPV1VMVFFDT0dBRkcyMUxRRkMgOiBNU0tEMVhDTEw2Wks3MlRSR1REN0lQVk9MTkJNTUxRWDRSNU5WTjZX
*/

class BasicAuth 
{

    private $basicAuth = "Nk5SSkRTWlFRQjFZQVJPV1VMVFFDT0dBRkcyMUxRRkMgOiBNU0tEMVhDTEw2Wks3MlRSR1REN0lQVk9MTkJNTUxRWDRSNU5WTjZX";
    

    public function getBasicAuth(){

        return $this->$basicAuth;

    }
    
}


?>