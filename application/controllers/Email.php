<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends CI_Controller 
{

	public function __construct()
	{
	  parent::__construct();
	  //load the  library
	  $this->load->library('email');
	  
	}

	public function index()
	{
		$config['protocol']    = "smtp";
$config['smtp_host']    = "smtp.1and1.com";
$config['smtp_port']    = "25";
$config['smtp_timeout'] = "7";
$config['smtp_user']    = "mukesh.p@olwaysoftware.info";
$config['smtp_pass']    = "Mukesh@php";
$config['charset']    = 'utf-8';
$config['newline']    = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not

$this->email->initialize($config);
$this->email->set_newline("\r\n");
echo $message=random_string('numeric', 6);
$this->email->from("mukesh.p@olwaysoftware.info", "Test Email");
$this->email->to("patelhasmukhi277@gmail.com");
$this->email->subject("Test");
$this->email->message($message);

if($this->email->send())
{
 	$data['msg']='Send';
}
else
{
 	$data['msg']='Not Send';
}
// echo $this->email->print_debugger();

//$this->load->view('emailresult',$data);
	  //   $config['protocol']= 'smtp';
   //      $config['smtp_host'] = 'smtp.1and1.com'; //ssl://smtp.googlemail.com smtp3.netcore.co.in
   //       $config['smtp_port'] = 25; // 587 // 465 // 25
   //       $config['smtp_user'] = 'mukesh.p@olwaysoftware.info';
   //       $config['smtp_pass'] = 'Mukesh@php';
   //       $config['mailtype'] = 'html';
   //       $config['charset']  = 'utf-8'; // iso-8859-;

   //    $this->load->library('email', $config);
	  // $this->email->from('patelhasmukhi277@gmail.com', 'hasmukhi');
	  // $this->email->to('patelhasmukhi277@gmail.com');
	  
	  // $this->email->subject('mail send demonstration');
	  // $this->email->message('this is testing');
	  
	  // 	if($this->email->send())
	  // 	{
	  // 		$data['msg'] = "email sent";
	  // 	}
	  // 	else
	  // 	{
	  // 		$data['msg'] = "email was not sent";	
	  // 	}
	  
	 	// //echo $this->email->print_debugger();
	 	// $this->load->view('emailresult',$data);
	 }
}