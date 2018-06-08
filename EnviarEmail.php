<?php

class EnviarEmail 
{
    
    public function enviar($remetemente,$assunto,$destino,$textoCorpo){

        $assuntoE = "$assunto";
        $destino = "$destino";
//        $subject  = $assunto;
        $from     = "$remetemente";
   //     $to       = $destino;
        $corpo = "<html><head><meta charset=UTF-8></head><body>$textoCorpo</body></html>";
        $bcc      = null; // Esconder endereços de e-mails.
        $cc       = null; // Qualquer destinatário pode ver os endereços de e-mail especificados nos camp


        $headers  = sprintf( 'Date: %s%s', date( "D, d M Y H:i:s O" ), PHP_EOL );
        $headers .= sprintf( 'Return-Path: %s%s', $from, PHP_EOL );
        $headers .= sprintf( 'To: %s%s', $to, PHP_EOL );
        $headers .= sprintf( 'Cc: %s%s', $cc, PHP_EOL );
        $headers .= sprintf( 'Bcc: %s%s', $bcc, PHP_EOL );
        $headers .= sprintf( 'From: %s%s', $from, PHP_EOL );
        $headers .= sprintf( 'Reply-To: %s%s', $from, PHP_EOL );
        $headers .= sprintf( 'Message-ID: <%s@%s>%s', md5( uniqid( rand( ), true ) ), $_SERVER[ 'HTTP_HOST' ], PHP_EOL );
        $headers .= sprintf( 'X-Priority: %d%s', 3, PHP_EOL );
        $headers .= sprintf( 'X-Mailer: PHP/%s%s', phpversion( ), PHP_EOL );
        $headers .= sprintf( 'Disposition-Notification-To: %s%s', $from, PHP_EOL );
        $headers .= sprintf( 'MIME-Version: 1.0%s', PHP_EOL );
        $headers .= sprintf( 'Content-Transfer-Encoding: 8bit%s', PHP_EOL );
        $headers .= sprintf( 'Content-Type: text/html; charset=UTF-8', PHP_EOL );


        $enviaremail = mail($destino, $assuntoE, $corpo, $headers );

        if($enviaremail)
        {
        //echo $corpo;
        header('Location: contato.html');

        } else {

        //  header('location: anuncio.php?id='.$idAnuncio.'&emailEnviado=true');
        header('Location: contato.html');
        }

    }

}


?>