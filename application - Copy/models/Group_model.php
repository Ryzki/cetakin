<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'groups';
        $this->primary_key = 'id'; 
        $this->protected = array('id');

		parent::__construct();
	}   
}
