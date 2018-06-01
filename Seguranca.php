<?php

    class Seguranca
    {
        
        function filtro($string){
            $aux = $this->getNull($string);
            $aux = $this->getSqlInjection($string);
            $aux = $this->getXSS($aux);
            return $aux;
        }

        function filtro2($string){
             $aux = $this->getNull($string);
             $aux = $this->getSqlInjection($string);
             $aux = $this->getXSS($aux);
             $aux = $this->letras($aux);
             return $aux;

        }

        function filtro3($string){
             $aux = $this->getNull($string);
             $aux = $this->letras($aux);
             $aux = $this->simNao($aux);
             return $aux;

        }


        function filtro4($string,$pag,$id){
            $aux = $this->getNull4($string,$pag,$id);
            $aux = $this->getSqlInjection($string);
            $aux = $this->getXSS($aux);
            return $aux;
        }

        private function getNull($string){
            if ($string == null || $string =="") {
              //  header("location:anunciar.php");
               // exit();
               return null;
            }else{
                return $string;
            }
        }


       private function getSqlInjection($string){
            $aux = addslashes($string);
            return $aux;
        }

       private function getXSS($string){
            $aux = htmlspecialchars($string);
            return $aux;
        }



        // ---------------------------------------------------------------------




         private function getNull4($string,$pag,$id){
            if ($string == null || $string =="") {
             header('Location:'.$pag."?funcao=cadastro&status=false&id=$id");
                exit();
            }else{
                return $string;
            }
        }

       private function letras($string){
            $aux =  preg_replace('/[^[:alpha:]_]/', '',$string);
            return $aux;
       }

       private function simNao($string){
           if (strcmp($string,"sim")||strcmp($string,"nao")) {
               return $string;
           }else{
             //  exit();
           }
       }


    }
    

?>