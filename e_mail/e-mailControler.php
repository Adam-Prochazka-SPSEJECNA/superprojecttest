<?php

$_Email_Controler_prefix = $_SERVER["DOCUMENT_ROOT"]."/eventReminder";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\SMTP;

require_once $_Email_Controler_prefix.'/PHPMailer/src/Exception.php';
require_once $_Email_Controler_prefix.'/PHPMailer/src/PHPMailer.php';
require_once $_Email_Controler_prefix.'/PHPMailer/src/SMTP.php';

/**
 * Class for controling/handling PHP mailer class
 * Get data from db table: SERVER_email
 */
class Email_Controler{

    private $HOST = null;
    private $Copy = [];
    private $Username = null;
    private $Password = null;
    private $From = null;
    private $FromName = null;
    private $To = [];
    private $Subject = null;
    private $Body = null;
    private $Attachment = [];
    private $hide_copy = [];

    function setHOST($input){
        $this->HOST = $input;
    }
    /**
     * Set adress to send copy
     * @param string $input (can by call in multiple times) store in array
     */
    function addCopy($input){
        array_push($this->Copy,$input);
    }
    function addHiddenCopy($input){
        $this->hide_copy = $input;
    }
    function setUserame($input){
        $this->Username = $input;
    }
    function setPassword($input){
        $this->Password = $input;
    }
    function setFrom($input){
        $this->From = $input;
    }
    function setFromName($input){
        $this->FromName = $input;
    }
    /**
     * Expect list
     */
    function setTo($input){
        $this->To = $input;
    }
    function setSubject($input){
        $this->Subject = $input;
    }
    function setBody($input){
        $this->Body = $input;
    }
    function setAttachment($file,$name){
        $temp_array = [$file,$name];
        array_push($this->Attachment,$temp_array);
    }
    /**
     * Function to set Host,Username,Password,From,FromName from DB
     */
    function set_all_auto(){

        static $auth_name;
        static $auth_psswd;
        static $jmeno_odesilatele;
        static $HOST;
        static $adress_from;

        $mysql = "SELECT auth_name,auth_psswd,jmeno_odesilatele,HOST,adress_from FROM SERVER_email where id = 1";
        $stmt = $GLOBALS["conn"] ->prepare($mysql);
        if($stmt === false){
            throw new Exception("DB err -01-");
            die;
        }
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($auth_name,$auth_psswd,$jmeno_odesilatele,$HOST,$adress_from);
        while ($stmt ->fetch()){}

        $this->setHOST($HOST);
        $this->setUserame($auth_name);
        $this->setPassword($auth_psswd);
        $this->setFromName($jmeno_odesilatele);
        $this->setFrom($adress_from);

    }
    /**
     * Function to send e-mail
     * @return bool if succesfuly send e-mail retrun true otherwise retrun false
     */
    function send(){

        try {

            $mail = new PHPMailer(true);
            $mail->setLanguage('cs', 'PHPMailer-master/language/phpmailer.lang-cs.php');
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP(); 
            $mail->Host       = $this->HOST; //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->Username;                     //SMTP username
            $mail->Password   = $this->Password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;  

            if(!empty($this->From) > 0){
                $mail->setFrom($this->From, $this->FromName);
            }

            if(count($this->hide_copy) > 0){
                for ($i=0; $i < count($this->hide_copy); $i++) { 
                    $mail->AddBCC($this->hide_copy[$i], ' ');
                }
            }

            if(count($this->Copy) > 0){
                for ($i=0; $i < count($this->Copy); $i++) { 
                    $mail->AddCC($this->Copy[$i], ' ');
                }
            }

            if(count($this->To) > 0){
                for ($i=0; $i < count($this->To); $i++) { 
                    $mail->addAddress($this->To[$i], ' ');
                }
            }else{
                if (empty($this->hide_copy)){
                    throw new Exception("Není zadán ani jeden příjemce");
                }
            }

            

            if(count($this->Attachment) > 0){
                for ($i=0; $i < count($this->Attachment); $i++) { 
                    $mail->addAttachment($this->Attachment[$i][0], $this->Attachment[$i][1]);
                }
            }

            $mail->isHTML(true);
            $mail->Subject = $this->Subject;
            $mail->Body = $this->Body;
            $mail->send();

        } catch (Exception $e){
            throw new Exception($e->getMessage());
            return false;
        }
        return true;
    }
}