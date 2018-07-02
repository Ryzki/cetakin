<?php

/**
* 
*/
class Pengaturan extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array('percetakan_model', 'petugas/petugas_model'));
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();
		$petugas = $this->petugas_model->where('idusers', $user->id)->get();

		$data['data'] = $this->percetakan_model->get($petugas->idpercetakan);

		$this->generateCsrf();
		$this->render('petugas/pengaturan/index', $data);
	}

	public function update()
	{
		$data = $this->input->post();
		$update = $this->percetakan_model->update($data, $data['id']);

		$this->message('Data berhasi di Ubah!', 'success');
		$this->go('petugas/pengaturan');
	}

}