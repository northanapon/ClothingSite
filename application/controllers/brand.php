<?php
class Brand extends CI_Controller {
    public function index($brand_id) {
        $data['page_title'] = "Welcome to BfashShop.com";
		$this->load->model('brand_model');
		$data['brand_list'] = $this->brand_model->get(); 				
		$data['page'] = 'brand_list';
        $this->load->view('main_page',$data);
    }
	public function product($brand_name,$brand_id,$product_id=FALSE,$item=0) 
	{
		if(check_authen('member',TRUE)) 
        {
			$data['sign_in_link']="authen/logout";
			$data['sign_in']="sign out";
        }
		else
		{
			$data['sign_in_link']="authen/login";
			$data['sign_in']="sign in";
		}	
		
		$this->load->model('brand_model');
		$this->load->model('product_model');
		$this->load->model('image_model');
		$this->load->model('category_model');
			
		if($product_id===FALSE)
		{
			//set common page
			$data['page_title'] = "Welcome to BfashShop.com";
			$data['brand_list'] = $this->brand_model->get(); 
			$data['re_name'] = str_replace('-',' ',$brand_name);
			$data['brands'] = $this->brand_model->get_by_name($brand_id); 
			$data['page'] = 'front_product\content_main_product_list';
			$data['content_history'] ='common\content-history';
			$data['previous'] = array("Home");
			$data['current'] =  $brand_name;
			$data['women_categories'] = $this->category_model->get_by_gender('WOMEN');
			$data['men_categories'] = $this->category_model->get_by_gender('MEN');
			$data['base_url'] = base_url().'brand/'.$brand_name;
			//END set common
			
			//set product
			$data['products'] = $this->product_model->get_product_brand_image($brand_id);	
			$data['num_item'] = count($data['products']);
			$data['show_start'] = 1;
			$data['show_end'] = 20;
			if($data['show_end']>$data['num_item'])
			{
				$data['show_end'] = $data['num_item'];
			}
			$data['per_page'] = 20;
			if($data['show_end']==0)
			{
				$data['show_end'] = 1;
			}
			$data['num_page'] = ceil($data['num_item']/$data['show_end']); // CHANGE to 20
			$data['current_page'] = 1;
			
			$this->load->view('main_page',$data);
		}
		else if($product_id!=FALSE)
		{
			$data['page_title'] = "Welcome to BfashShop.com";
			$data['product_detail'] = $this->product_model->get_main_image($product_id);
			$data['sub_image'] = $this->product_model->get_sub_image($product_id);
			$data['logo'] = $this->product_model->get_product_brand_image($brand_name);
			$data['item_detail_size'] = $this->product_model->get_item_detail_size($product_id);
			$data['item_detail_color'] = $this->product_model->get_item_detail_color($product_id);
			
			$data['brand_list'] = $this->brand_model->get(); 
			$data['re_name'] = str_replace('-',' ',$brand_name);
			$data['brands'] = $this->brand_model->get_by_name($data['re_name']); 
			$data['products'] = $this->product_model->get_product_brand_image($data['re_name']);		
			$data['page'] = 'front_product\content_main_product_name';
			$data['content_history'] ='common\content-history';
			$data['previous'] = array("Home","brand");
			$data['current'] = 'brand/'.$brand_name;
			$data['current_url'] = $brand_name.'/'.$product_id;
			$this->load->view('main_page',$data);
		}
    }

	public function product_list( $brand_name,$brand_id, $page=0, $per_page=0 ) {
		if(check_authen('member',TRUE)) 
        {
			$data['sign_in_link']="authen/logout";
			$data['sign_in']="sign out";
        }
		else
		{
			$data['sign_in_link']="authen/login";
			$data['sign_in']="sign in";
		}	
		$this->load->model('brand_model');
		$this->load->model('product_model');
		$this->load->model('image_model');
		$this->load->model('category_model');
		//set common page
		$data['page_title'] = "Welcome to BfashShop.com";
		$data['brand_list'] = $this->brand_model->get(); 
		$data['re_name'] = str_replace('-',' ',$brand_name);
		$data['brands'] = $this->brand_model->get_by_name($brand_id); 
		$data['page'] = 'front_product\content_main_product_list';
		$data['content_history'] ='common\content-history';
		$data['previous'] = array("Home");
		$data['current'] =  $brand_name;
		$data['women_categories'] = $this->category_model->get_by_gender('WOMEN');
		$data['men_categories'] = $this->category_model->get_by_gender('MEN');
		$data['base_url'] = base_url().'brand/'.$brand_name;
		//END set common
		
		$data['num_item'] = count($data['products']);
			if($per_page == 0)
			{
				$data['show_end'] = $data['num_item'];
				$data['show_start'] = 1;
				$data['per_page'] = $data['num_item'];
				$data['num_page'] = 1; 
				$data['current_page'] = $page;
				$this->load->view('main_page',$data);
				return ;
			}
			
			$data['show_end'] = $per_page*$page;
			$data['show_start'] = ($per_page*($page-1)+1);
			if($data['show_start']>$data['num_item'])
			{
				$data['show_start'] = $data['show_start']-($data['show_start']-$data['num_item']);
			}
			if($page == 1)
			{
				$data['show_start'] = 1;
			}
			if($data['show_end']>$data['num_item']){
				$data['show_end'] = $data['show_end']-($data['show_end']-$data['num_item']);
			}
			$data['per_page'] = $per_page;
			$data['num_page'] = ceil($data['num_item']/$per_page); // CHANGE to 20
			$data['current_page'] = $page;
		
		$this->load->view('main_page',$data);
	}
}
?>
