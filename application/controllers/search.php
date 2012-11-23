<?php 
class Search extends CI_Controller 
{	public function index($search) 
{
        $data['page_title'] = "Welcome to BfashShop.com";
		$this->load->model('product_model');
		$data['brand_list'] = $this->brand_model->get(); 				
		$data['page'] = 'product_list';
        $this->load->view('main_page',$data);
    }
	public function product($search) 
	{
		$this->load->model('bfash_model');
		$this->load->model('product_model');
		$this->load->model('image_model');
		$this->load->model('category_model');
				
		$data = $this->bfash_model->init();
		
		$this->lang->load('content-history', $this->language_model->get());
		$this->lang->load('content_main_product_list', $this->language_model->get());
	
		$data['re_name'] = str_replace('-',' ',$search_cat);
		
		$data['base_url'] = base_url().'search/'.$search.'/page/'.$page.'/'.$per_page;
		
		//breadcrumbs
		$data['breadcrumbs'] = array($this->lang->line('Home'), $search);
		$data['link'] = array(site_url(), site_url().'search/'.$page.'/'.$per_page);
		$data['products'] = $this->product_model->search_by_name($search);	
		$data['page'] = 'front_product/content_main_product_list';
			
		//set page history
		$this->session->set_userdata('redirect',current_url());
		
		//set product
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

	public function product_list( $search, $page=0, $per_page=0 )
    {
		$this->load->model('bfash_model');
		$this->load->model('product_model');
		$this->load->model('image_model');
		$this->load->model('category_model');
		
		$data = $this->bfash_model->init();
		$this->lang->load('content-history', $this->language_model->get());
		$this->lang->load('content_main_product_list', $this->language_model->get());
		
		$data['re_name'] = str_replace('-',' ',$search);
		$data['products'] = $this->product_model->search_by_name($search);

		$data['base_url'] = base_url().'search/'.$search.'/page/'.$page.'/'.$per_page;
		//breadcrumbs
		$data['breadcrumbs'] = array($this->lang->line('Home'), $search);
		$data['link'] = array(site_url(), site_url().'search/'.$page.'/'.$per_page);
		$data['page'] = 'front_product/content_main_product_list';
		
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
