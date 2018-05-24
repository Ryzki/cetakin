<?php

/**
 * 
 */
class Saldo_percetakan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'date', 'utility', 'number')); 
		$this->load->model('saldo_percetakan_model');
		$this->load->model('petugas/petugas_model');
	}

	public function index()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'petugas/saldo/index/';
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

		$data = $this->saldo_percetakan_model
			->limit($config['per_page'], $offset = $start)
			->where('id_percetakan', $this->petugas_model->getPercetakan())
			->get_all();
		$config['total_rows'] = $this->saldo_percetakan_model
			->where('id_percetakan', $this->petugas_model->getPercetakan())
			->count_rows();

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'tampildata' => $data,
			'total_saldo' => $this->saldo_percetakan_model->getJumlahSaldo($this->petugas_model->getPercetakan()),
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);

		$this->generateCsrf();

		$this->render('petugas/saldo/index', $data);
	}


}