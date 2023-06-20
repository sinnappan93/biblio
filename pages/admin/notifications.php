    <!-- <?php

    // $to ="mehdi.tran.99@gmail.com";
    // $subject ="Utilisation de mail() avec PHP depuis Windows";
    // $message = "Salut, comment ça va ? ";

    // $headers = "Content-Type: text/plain; charset=utf-8\r\n";
    // $headers .= "From: bibliothequeagenda0@gmail.com\r\n";



    // if(mail($to, $subject, $message, $headers))
    //     echo "Envoye !";
    // else
    //     echo 'Erreur envoi';

    



    // To
    $to = 'sinnappan93@gmail.com';
    
    // Subject
    $subject = 'Wesh tranquille ou quoi ?';
    
    // clé aléatoire de limite
    $boundary = md5(uniqid(microtime(), TRUE));
    
    // Headers
    $headers = 'From: Agenda Bibliothèque <bibliothequeagenda0@gmail.com>'."\r\n";
    $headers .= 'Mime-Version: 1.0'."\r\n";
    $headers .= 'Content-Type: multipart/mixed;boundary='.$boundary."\r\n";
    $headers .= "\r\n";
    
    // Message
    $msg = 'Veuillez signaler erreur en retour de ce mail'."\r\n\r\n";
    
    // Message HTML
    $msg .= '--'.$boundary."\r\n";
    $msg .= 'Content-type: text/html; charset=utf-8'."\r\n\r\n";

    
    // Pièce jointe 1
    $file_name = 'C:/Users/ADMIN/Pictures/test.png';
    if (file_exists($file_name))
    {
        $file_type = filetype($file_name);
        $file_size = filesize($file_name);
    
        $handle = fopen($file_name, 'r') or die('File '.$file_name.'can t be open');
        $content = fread($handle, $file_size);
        $content = chunk_split(base64_encode($content));
        $f = fclose($handle);
    
        $msg .= '--'.$boundary."\r\n";
        $msg .= 'Content-type:'.$file_type.';name='.$file_name."\r\n";
        $msg .= 'Content-transfer-encoding:base64'."\r\n\r\n";
        $msg .= $content."\r\n";
    }

    
    // Fin
    $msg .= '--'.$boundary."\r\n";
    
    // Function mail()
    mail($to, $subject, $msg, $headers);

    ?>