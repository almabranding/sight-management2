<?php
class Form_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function register() {
        $data=array(
            'Name'      => $_POST['name'],
            'Phone'     => $_POST['phone'],
            'Email'     => $_POST['email']
        );
        $this->ValidarDatos($data['email']);
	$mail="dmartin@terragroup.com,nherrera@terragroup.com,info@groveatgrandbay.com,pfreedman@groveatgrandbay.com,lbarroso@terragroup.com";
	$to = $mail;
	$subject = "User Register";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: info@groveatgrandbay.com" . "\r\n";
	$body = "";
        foreach($data as $key=>$value)
            $body.= $key.': '.$value.'<br/>';		
	mail($to, $subject, $body, $headers); 

        $body ="Dear ".$_POST['name'].",<br/>Thank you for your interest in Grove at Grand Bay.  We'll be in touch shortly.";
        mail($_POST['email'], $subject, $body, $headers); 
    }
    
}