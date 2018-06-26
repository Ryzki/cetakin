<?php

/**
*
*/
class Homepage extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->root_view = "pelanggan/";
		$this->load->model(array('pelanggan/user_model'));
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();
		$data['data'] = $this->user_model->get($user->id);

		$this->generateCsrf();
		$this->render('pelanggan/user/edit', $data);
	}

	public function update_profile()
	{
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required|min_length[3]|max_length[100]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['data'] = (object)$this->input->post();

 			$this->generateCsrf();
 			$this->render('pelanggan/user/edit', $data);
		} else {
			$data = $this->input->post();

			$data['ip_address'] = $this->input->ip_address();
	    $update = $this->user_model->update($data, $this->input->post('id'));

	 		if ($update === FALSE) {
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("pelanggan");
	 		} else {
	 			$this->message('Profil berhasil di Ubah!', 'success');
	 			$this->go("pelanggan");
	 		}
		}
	}

}
