<?php

/**
* 
*/
class Sdk extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->root_view = "admin/";
		$this->load->model('admin/sdk_model');
	}

	public function index()
	{
		// pagination
        $start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/sdk/index/';
		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>"; 
        $config['per_page'] = 2; 
  
  		$data = $this->sdk_model
            ->limit($config['per_page'],$offset=$start)
			->get_all();    
   	 	$config['total_rows'] = $this->sdk_model
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'tampildata' => $data, 
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'], 
            'start' => $start,  
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();     

		$this->render('admin/sdk/index', $data);
	}
 
    public function search()
    { 
    	$search_data = $this->input->get();

        $data = $this->sdk_model->search($search_data);
 
        $this->generateCsrf();  
		$this->render('admin/sdk/index', $data);
    } 

	public function add()
	{
		$this->generateCsrf();
		$this->render('admin/sdk/add');
	}
		public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[3]|max_length[200]');
		$this->form_validation->set_rules('target', 'Target', 'trim|required|min_length[1]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == FALSE) {

			$this->generateCsrf();
			$this->render('admin/sdk/add');		
		} else {
			$data = $this->input->post();
			$insert = $this->sdk_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/sdk'); //redirect ke sdk
			}	
		}

	}

		public function edit($id)
	{
		$data['data'] = $this->sdk_model->get($id);

		$this->generateCsrf();
		$this->render('admin/sdk/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[3]|max_length[200]');
		$this->form_validation->set_rules('target', 'Target', 'trim|required|min_length[1]|max_length[25]');

		// end form validation

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/sdk/edit', $data);		
		} else {
			$data = $this->input->post();
			$insert = $this->sdk_model->update($data, $this->input->post('id'));
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/sdk'); //redirect ke sdk
			}	
		}

	}

	public function view($id)
	{
		$data['data'] = $this->sdk_model->get($id);

		$this->generateCsrf();
		$this->render('admin/sdk/view', $data);
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->sdk_model->delete($id);
		$this->go('admin/sdk');
	}
}