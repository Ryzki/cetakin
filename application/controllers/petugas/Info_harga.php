<?php

/**
 *
 */
class Info_harga extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump'));
		$this->root_view = "petugas/";
		$this->load->model('petugas/info_harga_model');
		$this->load->model('petugas/petugas_model');
		$this->load->model(array('petugas/info_harga_model'));
	}

	public function dokumen()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'petugas/info_harga/dokumen/';
		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
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
			->where('kategori', '0')
			->limit($config['per_page'], $offset = $start)
			->where('idpercetakan', $petugas->idpercetakan)
			->get_all();
		$config['total_rows'] = $this->info_harga_model
			->where('kategori', '0')
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

		$this->render('petugas/info_harga/dokumen_index', $data);
	}

	public function dokumen_search()
	{
		$search_data = $this->input->get();

		$data = $this->info_harga_model->search($search_data);

		$this->generateCsrf();
		$this->render('petugas/info_harga/dokumen_index', $data);
	}

	public function dokumen_add()
	{
		$this->generateCsrf();
		$this->render('petugas/info_harga/dokumen_add');
	}
	public function dokumen_save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('petugas/info_harga/dokumen_add');
		} else {
			$data = $this->input->post();
			$data['idpercetakan'] = $this->petugas_model->getPercetakan();
			$data['kategori'] = '0';

			$insert = $this->info_harga_model->insert($data);
			if ($insert == false) {
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
		$this->render('petugas/info_harga/dokumen_edit', $data);
	}
	public function dokumen_update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('petugas/info_harga/dokumen_edit', $data);
		} else {
			$data = $this->input->post();
			$insert = $this->info_harga_model->update($data, $this->input->post('id'));
			if ($insert == false) {
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
		$this->render('petugas/info_harga/dokumen_view', $data);
	}

	public function dokumen_delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->info_harga_model->delete($id);
		$this->go('petugas/info_harga/dokumen');
	}

	public function foto()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'petugas/info_harga/foto/';
		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
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
			->where('kategori', '1')
			->limit($config['per_page'], $offset = $start)
			->where('idpercetakan', $petugas->idpercetakan)
			->get_all();
		$config['total_rows'] = $this->info_harga_model
			->where('kategori', '1')
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

		$this->render('petugas/info_harga/foto_index', $data);
	}

	public function foto_search()
	{
		$search_data = $this->input->get();

		$data = $this->info_harga_model->search($search_data);

		$this->generateCsrf();
		$this->render('petugas/info_harga/foto_index', $data);
	}

	public function foto_add()
	{
		$this->generateCsrf();
		$this->render('petugas/info_harga/foto_add');
	}
	public function foto_save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('petugas/info_harga/foto_add');
		} else {
			$data = $this->input->post();
			$data['idpercetakan'] = $this->petugas_model->getPercetakan();
			$data['kategori'] = '1';

			$insert = $this->info_harga_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('petugas/info_harga/foto'); //redirect ke info_harga
			}
		}

	}

	public function foto_edit($id)
	{
		$data['data'] = $this->info_harga_model->get($id);

		$this->generateCsrf();
		$this->render('petugas/info_harga/foto_edit', $data);
	}
	public function foto_update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('petugas/info_harga/foto_edit', $data);
		} else {
			$data = $this->input->post();
			$insert = $this->info_harga_model->update($data, $this->input->post('id'));
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('petugas/info_harga/foto'); //redirect ke info_harga
			}
		}

	}

	public function foto_view($id)
	{
		$data['data'] = $this->info_harga_model->get($id);

		$this->generateCsrf();
		$this->render('petugas/info_harga/foto_view', $data);
	}

	public function foto_delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->info_harga_model->delete($id);
		$this->go('petugas/info_harga/foto');
	}

}
