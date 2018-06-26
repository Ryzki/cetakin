<?php

/**
 *
 */
class Pesanan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'date', 'number'));
		$this->load->model('pelanggan/pesanan_dokumen_model');
		$this->load->model('pelanggan/pesanan_foto_model');
		$this->load->model('petugas/info_harga_model');
		$this->load->model('percetakan_model');
		$this->load->model('w_kecamatan_model');
		$this->load->model('w_kabupaten_model');
	}

	public function index()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'pelanggan/pesanan/index/';
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

		$data = $this->pesanan_dokumen_model
			->where('idusers', $user->id)
			->limit($config['per_page'], $offset = $start)
			->with_relasipercetakan()
			->order_by('created_at', 'DESC')
			->get_all();
		$config['total_rows'] = $this->pesanan_dokumen_model
			->with_relasipercetakan()
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
		$this->render('pelanggan/pesanan/index', $data);
	}

	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->pesanan_dokumen_model->search($search_data);

		$this->generateCsrf();
		$this->render('pelanggan/pesanan/index', $data);
	}

	public function view($id)
	{
		$data['data'] = $this->pesanan_dokumen_model->get($id);

		$data['jenis_cetak'] = $this->info_harga_model->get($data['data']->idjeniscetak);
		$data['jumlah_sisi'] = $this->info_harga_model->get($data['data']->idjumlahsisi);
		$data['jumlah_status_jilid'] = $this->info_harga_model->get($data['data']->idstatusjilid);

		$data['percetakan'] = $this->percetakan_model
			->with_kecamatan()
			->with_kabupaten()
			->get($data['data']->idpercetakan); 

		$this->generateCsrf();
		$this->render('pelanggan/pesanan/view', $data);
	}

	public function batalkan($id='')
	{
		$data['status'] = '4';
		$this->pesanan_dokumen_model->update($data, $id);
		$this->go('pelanggan/pesanan/view/'.$id);
	}
}
