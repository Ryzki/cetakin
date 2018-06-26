<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class W_kecamatan_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'w_kecamatan';
        $this->primary_key = 'id'; 
        $this->protected = array('id');

		parent::__construct();
	}   
}
