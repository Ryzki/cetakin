<?php

/**
 *
 */
class Saldo_user extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility', 'number'));
		$this->root_view = "pelanggan/";
		$this->load->model('pelanggan/saldo_user_model');
		$this->load->model('pelanggan/bukti_model');
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();

		$data['tampildata'] = $this->saldo_user_model
			->where('id_users', $user->id)
			->get_all();
		$data['jumlah_saldo'] = $this->saldo_user_model->getJumlahSaldo($user->id);

		$this->generateCsrf();
		$this->render('pelanggan/saldo/index', $data);
	}

	public function view($id = '')
	{
		$data['data'] = $this->saldo_user_model->get($id);

		$this->generateCsrf();
		$this->render('pelanggan/saldo/view', $data);
	}

	public function add()
	{
		$user = $this->ion_auth->user()->row();

		$data['nominal'] = $this->input->post('jumlah');
		$data['id_users'] = $user->id;
		$data['keterangan'] = 'Pengisian Saldo';
		$data['status'] = '3';

		$insert = $this->saldo_user_model->insert($data);

		$data_bukti['id_saldo'] = $insert;
		$data_bukti['nama_rek'] = $this->input->post('nama_rek');
		$data_bukti['no_rek'] = $this->input->post('no_rek');

		if (!empty($_FILES['foto']['tmp_name'])) {
			$file_name = $this->upload_foto();
			$data_bukti['foto'] = $file_name;
		}

		$this->bukti_model->insert($data_bukti);

		$this->message('Menunggu konfirmasi transfer dari admin', 'success');
		$this->go('pelanggan/saldo_user/view/' . $insert);
	}

	public function konfirmasi()
	{
		$this->form_validation->set_rules('nama_rek', 'Nama Rekening', 'trim|required|min_length[3]|max_length[35]');
		$this->form_validation->set_rules('no_rek', 'No. Rekening', 'trim|required|min_length[3]|max_length[35]');

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('pelanggan/saldo/view/' . $this->input->post('id_saldo'));
		} else {
			$data = $this->input->post();

			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name = $this->upload_foto();
				$data['foto'] = $file_name;
			}

			$insert = $this->bukti_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->saldo_user_model->update(array('status' => '3'), $this->input->post('id_saldo'));

				$this->go('pelanggan/saldo_user/view/' . $this->input->post('id_saldo'));
			}
		}
	}

	function upload_foto()
	{
		$set_name = fileName(1, 'BKT', '', 8);
		$path = $_FILES['foto']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/bukti_tf/';
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
}
