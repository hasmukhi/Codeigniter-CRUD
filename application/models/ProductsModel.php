<?php
class ProductsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }    
    public function get_products()
    {
    	//$this->db->select('*');
        //$this->db->from('products');
    	$query = $this->db->get('products');
    	return $query->result();
    }
    public function record_count() 
    {
          // return $this->db->count_all_results('products');

        $result = $this->db->query("select count(*) as c from products");
        $row = $result->row_array();
        return $row['c'];
    }
    public function get_products1($page=0,$perpage=5)
    {
        //$list=array();
                 $page = $page-1;
        if ($page<0) { 
            $page = 0;
        }
         $from = $page*$perpage;
         //echo $perpage;
        //  echo $page;
         //echo $from;
        $this->db->order_by("id", "desc");  // or date, etc
        $this->db->limit($perpage, $from);
        $query = $this->db->get("products",$page,$perpage);
        $result = $query->result_array();
        return $result;
        //$this->db->select('*');
        //$this->db->from('products');
        // $this->db->limit($page,$perpage);
        // $query=$this->db->get('products');
        // return $query->result_array();
       // return $result;
        //return $result;
        //  $this->db->from('products');
        //  $this->db->limit($page,$perpage);
        //  $query=$this->db->get();
        if($query->num_rows()>0)
        foreach ($query->result() as $row) {
            $list[] = $row;

        }
        // return $list;
//         $this->$db->limit($limit,$start);
//         $query = $this->db->get('products');
//         if ($no > 0)
//         {           
//             foreach ($query->result() as $row)
//             {
//                 $data[] = $row;
//                 // print_r($data);
//             }
//             return $data;
//         }
//         else
//         {
//             return false;
//         }
    }
    public function insert_product()
    {
    	$data=array(
    		'title' => $this->input->post('title'),
    		'description' =>$this->input->post('description')
    	);
    	return $this->db->insert('products',$data);
    }
    public function update_product($id)
    {
        $data=array(   
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );
        if($id==0)
        {
            return $this->db->insert('product',$data);
        }
        else
        {
            $this->db->where('id',$id);
            return $this->db->update('products',$data);
        }
    }
    public function insert_image($image_name,$image)
    {
        $data=array(
            'image_name' => $image_name,
            'image' => $image 
        );
        return $this->db->insert('category',$data);
    }
    /*public function get_products(){
        if(!empty($this->input->get("search"))){
          $this->db->like('title', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search")); 
        }
        $query = $this->db->get("products");
        return $query->result();
    }
    */
}
?>
