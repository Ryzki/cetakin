<?php

/**
* 
*/
class Percetakan extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct(); 
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array(''));
		$this->load->model(array('petugas/petugas_model', 'percetakan_model', 'w_provinsi_model','w_kabupaten_model','w_kecamatan_model'));
	}

	public function index()
	{ 
		$id_percetakan = $this->petugas_model->getPercetakan();
		$data['percetakan'] = $this->percetakan_model->get($id_percetakan);  
		$data['provinsi'] = $this->w_provinsi_model->get_all();

		$kecamatan = $this->w_kecamatan_model->get($data['percetakan']->id_kecamatan);
		$data['id_kabupaten'] = $kecamatan->regency_id;	
		$kabupaten = $this->w_kabupaten_model->get($data['id_kabupaten']);
		$data['id_provinsi'] = $kabupaten->province_id;
		 
		$this->generateCsrf();
		$this->render('petugas/percetakan/index', $data);
	}

	public function update()
	{
		$data = $this->input->post();

		if (!empty($_FILES['foto']['name'])) {
			$foto_name    = $this->upload_foto();
			$data['foto'] = $foto_name;
		}

		$this->percetakan_model->update($data, $this->input->post('id'));

		$this->message('Berhasil di ubah!', 'success');
		$this->go("petugas/percetakan");
	}

	public function show($param = null)
	{ 
		if ($param == 'getKabupaten') {
			$provinsi_id = $_GET['prov_id'];
			$kab_id = $_GET['kab_id'];
			$data = $this->w_kabupaten_model->where('province_id', $provinsi_id)->get_all();

			echo '<option value="">== Pilih Kabupaten ==</option>';
			foreach ($data as $value) {
				if ($kab_id == $value->id) {
					echo '<option selected value="' . $value->id . '">' . $value->name . '</option>';
				} else { 
					echo '<option value="' . $value->id . '">' . $value->name . '</option>';
				}
			}
			die();
		} else if ($param == 'getKecamatan') {
			$kab_id = $_GET['kab_id']; 
			$data = $this->w_kecamatan_model->where('regency_id', $kab_id)->get_all();

			echo '<option value="">== Pilih Kecamatan</option>';
			foreach ($data as $value) { 
					echo '<option value="' . $value->id . '">' . $value->name . '</option>'; 
			}
			die();
		} else if ($param == 'getOngkir') {
			$kec_id = $_GET['kec_id'];

			$data = $this->ongkir_model->with_kurir()->where('id_kecamatan', $kec_id)->get_all();

			if ($data != false) {
				echo '<option value="">- Pilih Layanan - </option>';

				foreach ($data as $value) {
					echo '<option value="' . $value->id . '">' . $value->kurir->nama_kurir . ' - ' . rupiah($value->biaya) . '</option>';
				}
			} else {
				echo '<option value="">- Maaf pengiraman belum tersedia untuk daerah anda - </option>';
			}

			die();
		}
	}

	public function show_edit($param = null)
	{ 
		if ($param == 'getKabupaten') {
			$provinsi_id = $_GET['prov_id'];
			$kab_id = $_GET['kab_id'];
			$data = $this->w_kabupaten_model->where('province_id', $provinsi_id)->get_all();

			echo '<option value="">== Pilih Kabupaten ==</option>';
			foreach ($data as $value) {
				if ($kab_id == $value->id) {
					echo '<option selected value="' . $value->id . '">' . $value->name . '</option>';
				} else { 
					echo '<option value="' . $value->id . '">' . $value->name . '</option>';
				}
			}
			die();
		} else if ($param == 'getKecamatan') {
			$kab_id = $_GET['kab_id'];
			$kec_id = $_GET['kec_id'];
			$data = $this->w_kecamatan_model->where('regency_id', $kab_id)->get_all();

			echo '<option value="">== Pilih Kecamatan</option>';
			foreach ($data as $value) {
				if ($kec_id == $value->id) {
					echo '<option selected value="' . $value->id . '">' . $value->name . '</option>';
				} else { 
					echo '<option value="' . $value->id . '">' . $value->name . '</option>';
				}
			}
			die();
		} else if ($param == 'getOngkir') {
			$kec_id = $_GET['kec_id'];

			$data = $this->ongkir_model->with_kurir()->where('id_kecamatan', $kec_id)->get_all();

			if ($data != false) {
				echo '<option value="">- Pilih Layanan - </option>';

				foreach ($data as $value) {
					echo '<option value="' . $value->id . '">' . $value->kurir->nama_kurir . ' - ' . rupiah($value->biaya) . '</option>';
				}
			} else {
				echo '<option value="">- Maaf pengiraman belum tersedia untuk daerah anda - </option>';
			}

			die();
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

}