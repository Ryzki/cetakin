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
		$this->load->helper(array('number', 'utility'));
		$this->load->model(array('percetakan_model', 'user_model', 'petugas_model'));
		$this->load->model('pelanggan/pesanan_dokumen_model');
		$this->load->model('pelanggan/pesanan_foto_model');
		$this->load->model('petugas/info_harga_model');
		$this->load->model('pelanggan/saldo_user_model');
		$this->slug_config($this->percetakan_model->table, 'nama');
	}

	public function index()
	{
		//
		$this->render('percetakan/layanan');
	}

	public function daftar($jenis)
	{
		if ($jenis == 'dokumen') {
			$this->db->where('status_dokumen', '1');
			$this->db->where('status_verifikasi', '1');
			$query = $this->db->get('percetakan');
		} else if ($jenis == 'foto') {
			$this->db->where('status_foto', '1');
			$this->db->where('status_verifikasi', '1');
			$query = $this->db->get('percetakan');
		}

		$data['data'] = $query->result();
		$data['jenis'] = $jenis;

		$this->render('percetakan/daftar_percetakan', $data);
	}

	public function detail($id)
	{
		$user = $this->ion_auth->user()->row();
		$kategori = $this->uri->segment(4);

		if ($kategori == 'dokumen') {
			$data['data'] = $this->percetakan_model->get($id);
			$data['percetakan_lainnya'] = $this->percetakan_model
				->where('status_dokumen', '1')
				->where('status_verifikasi', '1')
				->get_all();
			$data['info_harga'] = $this->info_harga_model->where('idpercetakan', $id)->where('kategori', '0')->get_all();

			// form
			$data['jenis_cetak'] = $this->info_harga_model->where('idpercetakan', $id)->where('idklasifikasi', 1)->get_all();
			$data['jumlah_sisi'] = $this->info_harga_model->where('idpercetakan', $id)->where('idklasifikasi', 2)->get_all();
			$data['status_jilid'] = $this->info_harga_model->where('idpercetakan', $id)->where('idklasifikasi', 3)->get_all();

			// Ambil data saldo pelanggan 
			if (!empty($user)) {
				$data['saldo_pelanggan'] = $this->saldo_user_model->getJumlahSaldo($user->id); 
			} else {
				$data['saldo_pelanggan'] = '';
			}

			$this->generateCsrf();
			$this->render('percetakan/detail_percetakan_dokumen', $data);
		} else { // foto
			$data['data'] = $this->percetakan_model->get($id);
			$data['percetakan_lainnya'] = $this->percetakan_model
				->where('status_foto', '1')
				->where('status_verifikasi', '1')
				->get_all();
			$data['info_harga'] = $this->info_harga_model->where('idpercetakan', $id)->where('kategori', '1')->get_all();
			// dump($id);

			$this->generateCsrf();
			$this->render('percetakan/detail_percetakan_foto', $data);
		}
	}

	public function pendaftaran()
	{
		$this->generateCsrf();
		$this->render('percetakan/pendaftaran');
	}

	public function save()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[12]');
		$this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('percetakan/pendaftaran');
		} else {
			$data_percetakan = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'phone_percetakan' => $this->input->post('phone_percetakan'),
				'email' => $this->input->post('email_percetakan'),
				'slug' => $this->slug->create_uri($this->input->post('nama'))
			);
			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name = $this->upload_foto();
				$data_percetakan['foto'] = $file_name;
			}
			$insert_percetakan = $this->percetakan_model->insert($data_percetakan);

			$data_user = array(
				'first_name' => $this->input->post('first_name'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'phone' => $this->input->post('phone'),
				'group_id' => 2,
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'ip_address' => $this->input->ip_address(),
			);
			$insert_user = $this->user_model->insert($data_user);

			$data_petugas = array(
				'idusers' => $insert_user,
				'idpercetakan' => $insert_percetakan,
			);
			$insert_petugas = $this->petugas_model->insert($data_petugas);

			if ($insert_petugas == false) {
				echo "ada kesalahan";
			} else {
				$this->go('percetakan');
			}
		}

	}

	function upload_foto()
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

	public function cetak()
	{
		 // form validation 
		$this->form_validation->set_rules('jumlah_lembar', 'Jumlah Lembar', 'trim|required|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('jumlah_copy', 'Jumlah Copy', 'trim|required|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('catatan', 'catatan', 'trim|required|min_length[0]|max_length[255]');
		 // end form validation

		if ($this->form_validation->run() == false) {

			$data['data'] = $this->percetakan_model->get($this->input->post('idpercetakan'));
			$data['percetakan_lainnya'] = $this->percetakan_model->where('status_dokumen', '1')->get_all();
			 // dump($id);
			 
			$this->generateCsrf();
			$this->render('percetakan/detail_percetakan', $data);
		} else {
			$user = $this->ion_auth->user()->row();

			$data = $this->input->post();
			$data['idusers'] = $user->id;
			$data['kode_cetak'] = $this->pesanan_dokumen_model->generateKodeCetak();

			if (!empty($_FILES['file'])) {
				$file_name = $this->upload_file();
				$data['file'] = $file_name;
			} 

			$insert = $this->pesanan_dokumen_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('pelanggan/pesanan'); 
			}
		}

	}

	public function cetak_foto()
	{
		 // form validation
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules('jumlah_copy', 'Jumlah Copy', 'trim|required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('catatan', 'catatan', 'trim|required|min_length[0]|max_length[200]');
		 // end form validation

		if ($this->form_validation->run() == false) {

			$data['data'] = $this->percetakan_model->get($this->input->post('idpercetakan'));
			$data['percetakan_lainnya'] = $this->percetakan_model->where('status_dokumen', '1')->get_all();
			 // dump($id);

			$this->generateCsrf();
			$this->render('percetakan/detail_percetakan', $data);
		} else {
			$user = $this->ion_auth->user()->row();

			$data = $this->input->post();
			$data['idusers'] = $user->id;
			$data['kode_pengambilan'] = $this->pesanan_foto_model->kode_pengambilan_foto();

			if (!empty($_FILES['file']['tmp_name'])) {
				$file_name = $this->upload_cetak_foto();
				$data['file'] = $file_name;
			}

			$insert = $this->pesanan_foto_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('pelanggan/pesananft');
			}
		}

	}

	function upload_file()
	{
		$set_name = fileName(1, 'FL', '', 8);
		$path = $_FILES['file']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/percetakan/file/';
		$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
		$config['max_size'] = 150024;
		$config['file_name'] = $set_name . $extension;
		$this->load->library('upload', $config);
          // proses upload
		$upload = $this->upload->do_upload('file');

		if ($upload == false) {
			$error = array('error' => $this->upload->display_errors());
			dump($error);
		}

		$upload = $this->upload->data();

		return $upload['file_name'];
	}

	function upload_cetak_foto()
	{
		$set_name = fileName(1, 'FT', '', 8);
		$path = $_FILES['file']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/percetakan/foto/';
		$config['allowed_types'] = 'png|jpg|svg';
		$config['max_size'] = 10024;
		$config['file_name'] = $set_name . $extension;
		$this->load->library('upload', $config);
          // proses upload
		$upload = $this->upload->do_upload('file');

		if ($upload == false) {
			$error = array('error' => $this->upload->display_errors());
			dump($error);
		}

		$upload = $this->upload->data();

		return $upload['file_name'];
	}

	// DIBAWAH INI FUNGSI - FUNGSI AJAX
	public function kalkulasi_biaya()
	{
		$idjeniscetak = $this->input->post('idjeniscetak');
		$idjumlahsisi = $this->input->post('idjumlahsisi');
		$idstatusjilid = $this->input->post('idstatusjilid');
		$jumlah_lembar = (int)$this->input->post('jumlah_lembar');
		$jumlah_copy = (int)$this->input->post('jumlah_copy'); 

		// cek biaya jenis cetak
		$jeniscetak = $this->info_harga_model
			->where('id', $idjeniscetak)
			->get();
		// cek biaya jenis cetak
		$jumlahsisi = $this->info_harga_model
			->where('id', $idjumlahsisi)
			->get();
		// cek biaya jenis cetak
		$statusjilid = $this->info_harga_model
			->where('id', $idstatusjilid)
			->get();
		
		$biaya_jeniscetak  = (int)$jeniscetak->harga;
		$biaya_jumlahsisi  = (int)$jumlahsisi->harga;
		$biaya_statusjilid = (int)$statusjilid->harga;

		$biaya_sementara = ($biaya_jeniscetak + $biaya_jumlahsisi) * $jumlah_lembar + $biaya_statusjilid;
		$biaya = ($biaya_sementara * $jumlah_copy);

		echo $biaya;
	}
}
