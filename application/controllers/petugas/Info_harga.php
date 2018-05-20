<?php

/**
*
*/
class Info_harga extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->root_view = "petugas/";
		$this->load->model('petugas/info_harga_model');
		$this->load->model('petugas/petugas_model');
		$this->load->model(array('info_harga_model'));
	}

	public function dokumen()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'petugas/info_harga/dokumen/';
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
		$config['per_page'] = 10;

		$user = $this->ion_auth->user()->row();
		$petugas = $this->petugas_model->where('idusers', $user->id)->get();

		$data = $this->info_harga_model
		->limit($config['per_page'],$offset=$start)
		->where('idpercetakan', $petugas->idpercetakan)
		->get_all();
		$config['total_rows'] = $this->info_harga_model
		->where('idpercetakan', $petugas->idpercetakan)
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

		$this->render('petugas/info_harga/index', $data);
	}

	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->info_harga_model->search($search_data);

		$this->generateCsrf();
		$this->render('petugas/percetakan/dokumen', $data);
	}

	public function dokumen_add()
	{
		$this->generateCsrf();
		$this->render('petugas/info_harga/add');
	}
	public function dokumen_save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == FALSE) {

			$this->generateCsrf();
			$this->render('petugas/info_harga/add');
		} else {
			$data = $this->input->post();
			$data['idpercetakan'] = $this->petugas_model->getPercetakan();
			$data['kategori'] = '0';

			$insert = $this->info_harga_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('petugas/info_harga/dokumen'); //redirect ke info_harga
			}
		}

	}

	public function dokumen_edit($id)
	{
		$data['data'] = $this->info_harga_model->get($id);

		$this->generateCsrf();
		$this->render('petugas/info_harga/edit', $data);
	}
	public function dokumen_update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('petugas/info_harga/add', $data);
		} else {
			$data = $this->input->post();
			$insert = $this->info_harga_model->update($data, $this->input->post('id'));
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('petugas/info_harga/dokumen'); //redirect ke info_harga
			}
		}

	}

	public function dokumen_view($id)
	{
		$data['data'] = $this->info_harga_model->get($id);

		$this->generateCsrf();
		$this->render('petugas/info_harga/view', $data);
	}

	public function dokumen_delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->info_harga_model->delete($id);
		$this->go('petugas/info_harga/dokumen');
	}
}
