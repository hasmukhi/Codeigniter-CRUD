<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package Contact :  CodeIgniter Contact Form
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Contact Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contactform extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        // load email lib
        $this->load->library('email');
    }
    // contact
    public function index() 
    {
        // $this->load->view('header');
        $this->load->view('products/contact_form');
        // $this->load->view('');
    }
    
    // send information
    public function send() 
    {

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'required');


        if ($this->form_validation->run() == FALSE){
            $this->load->view('products/contact_form');
            // $errors = validation_errors();
            // echo json_encode(['error'=>$errors]);
        }else{
           // $data = $this->input->post();
            //print_r($data);
           $this->load->library('email');
           $config=array();
               $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'ssl://smtp.gmail.com';
                $config['smtp_port'] = '465';
                $config['smtp_user'] = 'patelhasmukhi277@gmail.com'; // email id
                $config['smtp_pass'] = 'krishna.1320'; // email password
                $config['mailtype'] = 'html';
                $config['wordwrap'] = TRUE;
                $config['charset'] = 'iso-8859-1';
                $config['newline'] = "\r\n"; //use double quotes here
                // $this->email->initialize($config);
                $this->load->library('email',$config);

                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $message = $this->input->post('message');
                $this->email->from($email, $name);
                $this->email->to('patelhasmukhi277@gmail.com');
                $this->email->subject('testing');
            $this->email->message($message);
            if ($this->email->send())
            {
                // mail sent
                echo "mail sent";
                //redirect(base_url('contact'));
            }
            else
            {
                //error
                // $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                echo "mail not sent";
                //redirect(base_url('contact'));
            }

        

        }
    }   

}
?>