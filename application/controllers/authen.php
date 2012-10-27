<?php

class Authen extends CI_Controller {
    public function index() {
         redirect();   
    }
    
    public function login_staff(){
        if (!$this->input->post('username')) { //no authen
            $this->_redirect(FALSE);
            return;
        }
        $this->load->library('encrypt');
        $this->load->model('staff_model');
        //check username
        $query = $this->staff_model->get_staff($this->input->post('username'));
        if($query->num_rows() <= 0){    //no username
            $this->_redirect(TRUE);
            return;
        }
        //check password
        $staff = $query->row();
        if($this->encrypt->decode($staff->password) != $this->input->post('password')){ //false password
            $this->_redirect(TRUE);
            return;
        }
        //session
        $data = array(
           'username'   => $staff->username,
           'logged_in'  => TRUE,
           'role'       => 'staff'
        );
        $this->session->set_userdata($data);
        //cookie
        if($this->input->post('remember-password') == 'on') {
            $cookie_user = array(
                'name'   => 'username',
                'value'  => $this->encrypt->encode($staff->username),
                'expire' => '2592000'
            );
            $cookie_role = array(
                'name'   => 'role',
                'value'  => $this->encrypt->encode('staff'),
                'expire' => '2592000'
            );
            $this->input->set_cookie($cookie_user);
            $this->input->set_cookie($cookie_role);
        }
        
        //SUCCESS!
        redirect($this->session->flashdata('redirect_url'));
    }
    
    function _redirect($fail_authen) {
        $data['page_title'] = 'Admin: Log In';
        if ($fail_authen)
            $data['error_message'] = 'Username or passward you entered is incorrect.';
        $this->session->set_flashdata('redirect_url', $this->session->flashdata('redirect_url'));
        $this->load->view('staff/login', $data);
    }
    
    public function logout()    {
        $this->session->sess_destroy();
        delete_cookie("username");
        delete_cookie("role");
        redirect();
    }
	//member authen
	public function login()
	{
		$this->load->view('member/login');	
	}
	
	 public function login_member()
	{				
		if (!$this->input->post('username')) 
		{ //no authen
			redirect('authen_member');
            return;
        }
		$this->load->library('encrypt');
		$this->load->model('member_model');
		$member = $this->member_model->get($this->input->post('username'));
		if($member==null)// incorrect username
		{
			$this->load->view('member/login');			
            return;
		}	
		$password = $member->password;			
		// check password			
		if($this->encrypt->decode($member->password)!=$this->input->post('password'))
		{
			$this->load->view('member/login');			
            return;
		}
		echo "Yes".$this->encrypt->decode($member->password);	
		//session
		$data = array(
           'username'   => $member->username,
           'logged_in'  => TRUE,
           'role'       => 'member'
        );
        $this->session->set_userdata($data);
		//cookie
        if($this->input->post('remember-password') == 'on') {
			
            $cookie_user = array(
                'name'   => 'username',
                'value'  => $this->encrypt->encode($member->username),
                'expire' => '2592000'
            );
            $cookie_role = array(
                'name'   => 'role',
                'value'  => $this->encrypt->encode('member'),
                'expire' => '2592000'
            );
            $this->input->set_cookie($cookie_user);
            $this->input->set_cookie($cookie_role);
			echo "on";
        }        
        //SUCCESS!
        redirect($this->session->flashdata('redirect_url'));		
    }
}