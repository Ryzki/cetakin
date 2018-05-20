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
}
