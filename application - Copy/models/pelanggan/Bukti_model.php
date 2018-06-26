<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bukti_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'bukti_transfer';
        $this->primary_key = 'id';
        $this->protected = array('id');

		parent::__construct();
	}
}
