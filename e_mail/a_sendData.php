<?php

session_start();
require_once("../conn.php");
require_once("e-mailControler.php");

if(!isset($_SESSION["login"])){
    echo "Vaše přihlášení vypšelo";
    die;
}

$array_emails = json_decode($_POST["emails_Json"]);
$predmet = $_POST["predmet"];
$text = $_POST["text"];

$fileName = basename($_FILES['img']['name']); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
$file = $_FILES['img']['tmp_name'];

try{

    $email_Controler = new Email_Controler();
    $email_Controler->set_all_auto();

    $body = '
    
        '.$text.'
    
    ';

    if(!empty($file)){
        $email_Controler->setAttachment($file,$fileName);
    }

    $email_Controler->setBody($body);
    $email_Controler->addHiddenCopy($array_emails);
    $email_Controler->setSubject($predmet);

    if(!$email_Controler->send()){
        echo "Něco se nepovedlo, při popsílání e-mailů";
    }

}catch(Exception $e){
   echo "err: ".$e->getMessage();
}

echo "E - maily byly zaslány.";



?>