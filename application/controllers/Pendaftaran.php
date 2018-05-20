<?php

/**
*
*/
class Pendaftaran extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array('user_model','group_model'));
        $this->load->helper('utility');
	}

	public function index()
	{
 		$this->generateCsrf();
		$this->render('auth/pendaftaran');
	}

	public function save()
	{
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
 			$this->generateCsrf();
 			$this->render('auth/pendaftaran');
		} else {
			$data = $this->input->post();

			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$data['ip_address'] = $this->input->ip_address();
			$data['group_id'] = '3';
	        $insert = $this->user_model->insert($data);

	 		if ($insert === FALSE) {
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("pendaftaran");
	 		} else {
	 			$this->message('Pendaftaran Berhasil! Silahkan masuk', 'success');
	 			$this->go("auth/login");
	 		}
		}
	}
}
