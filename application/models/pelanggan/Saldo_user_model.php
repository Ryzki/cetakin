<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_user_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'saldo_user';
		$this->primary_key = 'id';
		$this->protected = array('id');

		parent::__construct();
	}

	public function search($search_data)
	{
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'pelanggan/saldo/search/';
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

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
		$config['per_page'] = 2;

		if ($search_data['sort'] == 1) {
			$sort_by   = 'first_name';
			$sort_with = 'ASC';
		} else if ($search_data['sort'] == 2) {
			$sort_by   = 'first_name';
			$sort_with = 'DESC';
		} else {
			$sort_by   = '';
			$sort_with = '';
		}
		if ($search_data['filter'] == "") {
			$data = $this->Saldo_user_model
			->limit($config['per_page'],$offset=$start)
			->order_by($sort_by, $sort_with)
			->get_all();
			$config['total_rows'] = $this->Saldo_user_model
			->count_rows();
		} else {
			$data = $this->Saldo_user_model
			->limit($config['per_page'],$offset=$start)
			->where($search_data['filter'], 'like', $search_data['keyword'])
			->order_by($sort_by, $sort_with)
			->get_all();
			$config['total_rows'] = $this->Saldo_user_model
			->where($search_data['filter'], 'like', $search_data['keyword'])
			->count_rows();
		}

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'tampildata' => $data,
			'search_data' => $search_data,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);
		return $data;
	}

	public function getJumlahSaldo($id_users)
	{ 
		$pemasukan = (int)$this->getJumlahPemasukan($id_users);
		$pengeluaran = (int)$this->getJumlahPengeluaran($id_users);
		$jumlah_saldo = $pemasukan - $pengeluaran;

		return $jumlah_saldo;
	}

	public function getJumlahPemasukan($id_users)
	{
		$this->db->select_sum('nominal');
		$this->db->where('id_users', $id_users);
		$this->db->where('status', '0');
		$query = $this->db->get('saldo_user');
		if ($query->row()->nominal == NULL){
			return 0;
		} else {
			return $query->row()->nominal;
		}
	}

	public function getJumlahPengeluaran($id_users)
	{
		$this->db->select_sum('nominal');
		$this->db->where('id_users', $id_users);
		$this->db->where('status', '1');
		$query = $this->db->get('saldo_user');

		if ($query->row()->nominal == NULL){
			return 0;
		} else {
			return $query->row()->nominal;
		}
	}

}
