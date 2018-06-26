<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Klasifikasi_harga_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'klasifikasi_harga';
        $this->primary_key = 'id'; 
        // $this->soft_deletes = TRUE;
        $this->protected = array('id');

		parent::__construct();
	}  
}
