<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'petugas';
        $this->primary_key = 'id'; 
        $this->protected = array('id');

		parent::__construct();
	}   

	public function getPercetakan()
	{
		$user = $this->ion_auth->user()->row();

		$petugas = $this->petugas_model->where('idusers', $user->id)->get();
		
		return $petugas->idpercetakan;
	}
}
