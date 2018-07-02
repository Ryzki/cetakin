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
		$this->load->helper(array('dump', 'number'));
		$this->load->model('admin/pembelian_saldo_model');
		$this->load->model('admin/saldo_user_model');
		$this->load->model('saldo_percetakan_model');
	}

	public function index()
	{
		// pagination
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/pembelian_saldo/index/';
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
 

		$data = $this->saldo_percetakan_model
			->with_percetakan() 
			->where('status', '=', '1')
			->where('status', '=', '5', TRUE) 
			->limit($config['per_page'], $offset = $start) 
			->order_by('created_at', 'DESC')
			->get_all();
		$config['total_rows'] = $this->pembelian_saldo_model
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

		$this->render('admin/penarikan/percetakan/index', $data);
	}

	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->pembelian_saldo_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/pembelian_saldo/index', $data);
	}

	public function konfirmasi($id = '')
	{
		$data['status'] = '1';
		$this->saldo_percetakan_model->update($data, $id); 

		$this->go('admin/penarikan/percetakan');
	}

	public function batalkan($id = '')
	{
		$data['status'] = '5';
		$this->saldo_percetakan_model->update($data, $id); 

		$this->go('admin/penarikan/percetakan');
	}
 
}
