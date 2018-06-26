<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_dokumen_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'pesanan_dokumen';
		$this->primary_key = 'id';
		$this->protected = array('id');

		$this->has_one['relasipercetakan'] = array('Percetakan_model', 'id', 'idpercetakan');
		$this->has_one['relasiuser'] = array('User_model', 'id', 'idusers');

		parent::__construct();
	}

	public function search($search_data)
	{
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'pelanggan/pesanan/search/';
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);

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

		if ($search_data['sort'] == 1) {
			$sort_by = 'first_name';
			$sort_with = 'ASC';
		} else if ($search_data['sort'] == 2) {
			$sort_by = 'first_name';
			$sort_with = 'DESC';
		} else {
			$sort_by = '';
			$sort_with = '';
		}
		if ($search_data['filter'] == "") {
			$data = $this->pesanan_dokumen_model
				->limit($config['per_page'], $offset = $start)
				->order_by($sort_by, $sort_with)
				->get_all();
			$config['total_rows'] = $this->pesanan_dokumen_model
				->where('group_id', 3)
				->count_rows();
		} else {
			$data = $this->pesanan_dokumen_model
				->limit($config['per_page'], $offset = $start)
				->where($search_data['filter'], 'like', $search_data['keyword'])
				->order_by($sort_by, $sort_with)
				->get_all();
			$config['total_rows'] = $this->pesanan_dokumen_model
				->where('group_id', 3)
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

	public function kode_pengambilan_dokumen()
	{
		$this->db->select('RIGHT(pesanan_dokumen.kode_pengambilan,3) as kode', false);
		$this->db->order_by('kode_pengambilan', 'DESC');
		$query = $this->db->get('pesanan_dokumen');

		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodejadi = "DOK-" . $kodemax;
		return $kodejadi;
	}

	public function send_notif($token, $id_cetak)
	{
		$data = array(
			"to" => $token,
			"notification" => array("title" => "Proses Cetak Selesai", "body" => "Segera cek cetakan kamu!", "icon" => "icon.png", "sound" => "/notif.mp3", "click_action" => site_url('pelanggan/pesanan/view/' . $id_cetak))
		);
		$data_string = json_encode($data);

		$headers = array(
			'Authorization: key=AAAAV9uIZSE:APA91bEX8s-xecyhAVK67vPDEi-NdURNR73tZljIrFolsD8yjfgt03OzfCX_rgl3MLSXLwpTmXlBV44rQIwGZpl0_vYaRBcMv44lyLXFZRAAWDfS9O78T28vFxK8QwbDg_EDWSLKSxud',
			'Content-Type: application/json'
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

		$result = curl_exec($ch);

		curl_close($ch);
	}


}
