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
		$this->load->model(array('petugas/petugas_model', 'percetakan_model'));
	}

	public function index()
	{
		$id_percetakan = $this->petugas_model->getPercetakan();
		$data['percetakan'] = $this->percetakan_model->get($id_percetakan);  
		 
		$this->generateCsrf();
		$this->render('petugas/pengaturan/index', $data);
	}

	public function update()
	{ 
		$data = $this->input->post();
		$this->percetakan_model->update($data, $this->input->post('id'));

		$this->message('Berhasil di ubah!', 'success');
		$this->go("petugas/pengaturan");
	}

}