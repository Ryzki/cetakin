<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Percetakan_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'percetakan';
        $this->primary_key = 'id'; 
        $this->protected = array('id');

		parent::__construct();
	}   

	public function Get_data_percetakan($status_dokumen, $status_foto)
	{
		$this->db->where('status_dokumen', $status_dokumen);
		$this->db->where('status_verifikasi', '1'); 
		$query = $this->db->get($this->table);  
		
		return $query->result();
	}
}