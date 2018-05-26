<?php

/**
 *
 */
class Percetakan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility'));
		$this->load->model('admin/percetakan_model');
		$this->load->model('admin/petugas_model');
		$this->load->model('admin/user_model');
	}

	public function index()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/percetakan/index/';
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
		$config['per_page'] = 2;

		$data = $this->percetakan_model
			->limit($config['per_page'], $offset = $start)
			->get_all();
		$config['total_rows'] = $this->percetakan_model
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

		$this->render('admin/percetakan/index', $data);
	}

	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->Percetakan_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/percetakan/index', $data);
	}

	public function add()
	{
		$this->generateCsrf();
		$this->render('admin/percetakan/add');
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('email_percetakan', 'email_percetakan', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('phone_percetakan', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('foto', 'foto', 'trim|required|min_length[1]|max_length[200]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('admin/percetakan/add');
		} else {
			$data = $this->input->post();
			$insert = $this->percetakan_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/percetakan'); //redirect ke percetakan
			}
		}

	}

	public function edit($id)
	{
		$data['data'] = $this->percetakan_model->get($id);

		$this->generateCsrf();
		$this->render('admin/percetakan/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('email_percetakan', 'email_percetakan', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('phone_percetakan', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/percetakan/edit', $data);
		} else {
			$data = $this->input->post();
			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name = $this->upload_foto();
				$data['foto'] = $file_name;
			}
			$insert = $this->percetakan_model->update($data, $this->input->post('id'));
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/percetakan'); //redirect ke percetakan
			}
		}

	}

	public function view($id)
	{
		$data['data'] = $this->percetakan_model->get($id);
		$data['petugas'] = $this->petugas_model->where('idpercetakan', $id)
			->fields('id,idusers,idpercetakan') //manggil field tabel petugas yang akan ditampilkan
			->with_relasiuser('fields:first_name,email,phone,active') //manggil field tabel user yang akan ditampilkan
			->get_all();
		$this->generateCsrf();
		$this->render('admin/percetakan/view', $data);
	}

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->percetakan_model->delete($id);
		$this->go('admin/percetakan');
	}

	public function upload_foto()
	{
		$set_name = fileName(1, 'CTK', '', 8);
		$path = $_FILES['foto']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/percetakan/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 9024;
		$config['file_name'] = $set_name . $extension;
		$this->load->library('upload', $config);
          // proses upload
		$upload = $this->upload->do_upload('foto');

		if ($upload == false) {
			dump('Gambar gagal diupload! Periksa gambar');
		}

		$upload = $this->upload->data();

		return $upload['file_name'];
	}

    // function petugas
	public function add_petugas()
	{
		$this->generateCsrf();
		$this->render('admin/percetakan/add_petugas');
	}

	public function save_petugas()
	{
		// form validation
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|min_length[3]|max_length[25]|is_unique[users.email]',
			array(
				'is_unique' => 'Email ' . $this->input->post('email') . ' sudah ada'
			)
		);
		$this->form_validation->set_rules('phone', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|required|matches[password]');

		// end form validation

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('admin/percetakan/add_petugas');
		} else {
			$data = $this->input->post();
			$id_percetakan = $this->input->post('percetakan_id');

			unset($data['percetakan_id']);

			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$data['ip_address'] = $this->input->ip_address();

			$insert_user = $this->user_model->insert($data);

			$data_petugas = array(
				'idusers' => $insert_user,
				'idpercetakan' => $id_percetakan,
			);
			$insert_petugas = $this->petugas_model->insert($data_petugas);

			if ($insert_petugas == false) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/percetakan/view/' . $id_percetakan); //redirect ke percetakan
			}
		}

	}

	public function delete_petugas($id = '', $id_percetakan = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->db->delete('petugas', array('idusers' => $id));
		$this->user_model->delete($id);
		$this->go('admin/percetakan/view/' . $id_percetakan);
	}

	public function edit_petugas($id = '', $id_percetakan = '')
	{
		$data['data'] = $this->user_model->get($id);

		$this->generateCsrf();
		$this->render('admin/percetakan/edit_petugas', $data);
	}
	public function update_petugas()
	{
		// form validation
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('phone', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|matches[password]');

		// end form validation

		if ($this->form_validation->run() == false) {
			$data['data'] = (object)$this->input->post();

			$this->generateCsrf();
			$this->render('admin/percetakan/edit_petugas', $data);
		} else {
			$data = $this->input->post();
			$id_percetakan = $this->input->post('percetakan_id');

			unset($data['percetakan_id']);

			if (!empty($data['password'])) {
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			}

			$data['ip_address'] = $this->input->ip_address();

			$insert_user = $this->user_model->update($data, $this->input->post('id'));

			if ($insert_user == false) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/percetakan/view/' . $id_percetakan); //redirect ke percetakan
			}
		}

	}

	public function verifikasi($id = '')
	{
		$data['status_verifikasi'] = '1';
		$this->percetakan_model->update($data, $id);
		$this->go('admin/percetakan/view/' . $id);
	}


	public function tolak($id = '')
	{
		$data['status_verifikasi'] = '2';
		$this->percetakan_model->update($data, $id);
		$this->go('admin/percetakan/view/' . $id);
	}


	public function unverifikasi($id = '')
	{
		$data['status_verifikasi'] = '0';
		$this->percetakan_model->update($data, $id);
		$this->go('admin/percetakan/view/' . $id);
	}
}
