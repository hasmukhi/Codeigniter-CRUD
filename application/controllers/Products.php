<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller {
   /**
    * Get All Data from this method.
    *
    * @return Response
   */
    public $data = array();
   public function __construct() 
   {
    //load database in autoload libraries 
      parent::__construct(); 
      $this->load->model('ProductsModel');
      $this->load->library("pagination");      
   }
   public function index()
   {
   		$products =new ProductsModel;
   		$data['data']=$products->get_products();
   		$this->load->view('includes/header');
      //$this->load->view('products/form_validation');
   		$this->load->view('products/list',$data);
   		$this->load->view('includes/footer');
   }
   public function index1($offset=0)
   {
      $products =new ProductsModel;
      //$data['data']=$products->get_products();
      
      //$this->load->view('products/list',$data);
      $data=array();
      $config["base_url"] = base_url()."products/index1";
      
      $config["total_rows"] = $this->ProductsModel->record_count();
      //EDIT THIS
      $config["uri_segment"] = 3;
        // //EDIT THIS:
      $config["per_page"] = 5;
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = round($choice);
      $config['use_page_numbers'] = true; // use page numbers, or use the current row number (limit offset)
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // // styling/html stuff
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul><!--pagination-->';
      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>' . "\n";
      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>' . "\n";
      $config['next_link'] = 'Next &rarr;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>' . "\n";
      $config['prev_link'] = '&larr; Previous';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>' . "\n";
      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>' . "\n";
      $this->pagination->initialize($config);
      $data['results'] = $this->ProductsModel->get_products1($page,$config["per_page"]);
      $data["pagination"] = $this->pagination->create_links();
      $this->load->view("products/list1",$data);

        // $query = $this->ProductsModel->get_products1(5,$this->uri->segment(2));
        // $data['results'] = null;        
       // if($query){
        //  $data['results'] =  $query;
        // }
        // $this->load->view('products/list1', $data);
      // $products =new ProductsModel;
      // $data['data']=$products->get_products1();
      // $config = array();
      // $config["base_url"] = base_url() . "products/index1";
      // $config["total_rows"] = $this->ProductsModel->record_count();
      // $config["per_page"] = 5;
      // $config["uri_segment"] = 3;
      // $this->pagination->initialize($config);
      // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      // $data["results"] = $this->ProductsModel->get_products1($config["per_page"], $page);
      // $data["links"] = $this->pagination->create_links();
      // $this->load->view("products/list1", $data);

      // $this->load->view('includes/header');
      // $this->load->view('products/list',$data);
      // $this->load->view('includes/footer');
   }
   public function create()
   {
   		$this->load->view('includes/header');
   		$this->load->view('products/create');
   		$this->load->view('includes/footer');
   }
   public function store()
   {
   		$products=new ProductsModel();
   		$products->insert_product();
   		redirect(base_url('products'));
   }
   public function edit($id)
   {
      $product = $this->db->get_where('products',array('id' => $id))->row();
      $this->load->view('includes/header');
      $this->load->view('products/edit',array('product'=>$product));
      $this->load->view('includes/footer');
   }
   public function update($id)
   {
      $products=new ProductsModel;
      $products->update_product($id);
      redirect(base_url('products'));
   }
   public function delete($id)
   {
     	$this->db->where('id',$id);
      $this->db->delete('products');
      redirect(base_url('products'));
   }

   public function image_index()
   {
      $this->load->view('includes/header');
      $this->load->view('products/image_upload');
      $this->load->view('includes/footer');
    }
    public function do_upload()
    {

      $config['upload_path'] = 'upload/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //Allowing types
      // $config['encrypt_name'] = TRUE; //encrypt file name 
      $config['file_name'] = $_FILES['fimg']['name'];
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if(!empty($_FILES['fimg']['name'])){

          if ($this->upload->do_upload('fimg')){

              $data   = $this->upload->data();
              $image1  = $data['file_name']; //get file name
        $image_name  = $this->input->post('fname');
        $this->ProductsModel->insert_image($image_name,$image1);
        echo "Upload Successful";

      }else{
              echo "Upload failed. Image file must be gif|jpg|png|jpeg|bmp";
          }
                   
      }else{
      echo "Failed, Image file is empty.";
    }
        

        // $config['upload_path']          = './uploads/';
        // $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        // $this->load->library('upload', $config);

        //         if ( ! $this->upload->do_upload())
        //         {
        //                 $error = array('error' => $this->upload->display_errors());

        //                 $this->load->view('products/image_upload', $error);
        //         }
        //         else
        //         {
        //                 $data = array('upload_data' => $this->upload->data());

        //                 $this->load->view('products/image_upload', $data);
        //         }
        // // $this->upload->initialize($config);
      // if ($this->upload->do_upload('fimg'))
      // {
      //   $data=array('upload_data' => $this->upload->data());
      //   $fimg=$data['fimg'];
      //   //$this->load->view('products/image_upload', $data);
      // }
      // $this->ProductsModel->insert_image($fimg);
      // redirect(base_url('imageUpload'));
    }
   
}