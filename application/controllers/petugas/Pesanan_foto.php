<?php

/**
 *
 */
class Pesanan_foto extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'date', 'download', 'number'));
		$this->load->model('admin/petugas_model');
		$this->load->model('pelanggan/pesanan_foto_model');
		$this->load->model('pelanggan/saldo_user_model');
		$this->load->model('saldo_percetakan_model');
		$this->load->model('token_user_model');
	}

	public function index()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'petugas/pesanan_foto/index/';
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

		$data = $this->pesanan_foto_model
			->where('idpercetakan', $petugas->idpercetakan)
			->with_relasiuser()
			->limit($config['per_page'], $offset = $start)
			->order_by('created_at', 'DESC')
			->get_all();
		$config['total_rows'] = $this->pesanan_foto_model
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

		$this->render('petugas/pesanan_foto/index', $data);
	}

	public function view($id)
	{
		$data['data'] = $this->pesanan_foto_model
			->with_relasiuser()
			->get($id);
		$data['saldo_pelanggan'] = $this->saldo_user_model
			->getJumlahSaldo($data['data']->idusers);

		$this->generateCsrf();
		$this->render('petugas/pesanan_foto/view', $data);
	}

	public function proses($id = '')
	{
		$this->pesanan_foto_model->update(array('status' => '1'), $id);
		$this->go('petugas/pesanan_foto/view/' . $id);
	}

	public function tolak($id = '')
	{
		$this->pesanan_foto_model->update(array('status' => '3'), $id);
		$this->go('petugas/pesanan_foto/view/' . $id);
	}

	// public function selesai($id='')
	// {
	// 	$this->pesanan_foto_model->update(array('status'=>'2'), $id);
	// 	$this->go('petugas/pesanan_foto/view/'.$id);
	// }

	public function batalkan($id = '')
	{
		$this->pesanan_foto_model->update(array('status' => '0'), $id);
		$this->go('petugas/pesanan_foto/view/' . $id);
	}

	public function download_file($file = '')
	{
		force_download('uploads/percetakan/foto/' . $file, null);
	}

	public function selesai()
	{
		// form validation
		$this->form_validation->set_rules('biaya_cetak', 'Biaya Cetak', 'trim|required|min_length[2]|max_length[25]');
		$this->form_validation->set_rules('catatan_percetakan', 'Catatan', 'trim|max_length[255]');
		// end form validation
		$data = $this->input->post();

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->pesanan_foto_model
				->with_relasiuser()
				->get($id);
			$data['saldo_pelanggan'] = $this->saldo_user_model
				->getJumlahSaldo($data['data']->idusers);

			$this->generateCsrf();
			$this->render('petugas/pesanan_foto/view', $data);
		} else {
			$cetak = $this->pesanan_foto_model->get($data['id']);

			$saldo_pelanggan = (int)$this->saldo_user_model
				->getJumlahSaldo($cetak->idusers);
			$biaya_cetak = (int)$data['biaya_cetak'];

			if ($saldo_pelanggan <= $biaya_cetak) {
				$this->message('Saldo pelanggan tidak mencukupi, anda bisa membatalkan proses cetak', 'warning');
				$this->go('petugas/pesanan_foto/view/' . $data['id']);
			} else {
				$update = $this->pesanan_foto_model->update($data, $data['id']);

				$data_saldo = array(
					'id_users' => $cetak->idusers,
					'nominal' => $data['biaya_cetak'],
					'status' => '1',
					'keterangan' => 'Melakukan percetakan dengan kode ' . $cetak->kode_pengambilan,
				);
				$this->saldo_user_model->insert($data_saldo);

				// masukan saldo percetakan
				$data_saldo_p = array(
					'id_percetakan' => $cetak->idpercetakan,
					'nominal' => $data['biaya_cetak'],
					'status' => '0',
					'keterangan' => 'Melakukan percetakan dengan kode ' . $cetak->kode_pengambilan,
				);
				$this->saldo_percetakan_model->insert($data_saldo_p);

				// kirim notifikasi
				$token = $this->token_user_model->where('id_users', $cetak->idusers)->get_all();
				foreach ($token as $value) {
					$this->pesanan_foto_model->send_notif($value->token, $cetak->id);
				}

				if ($update == false) {
					echo "ada kesalahan";
				} else {
					$this->message('Berhasil dikirim', 'success');
					$this->go('petugas/pesanan_foto/view/' . $data['id']);
				}
			}


		}
	}

}
