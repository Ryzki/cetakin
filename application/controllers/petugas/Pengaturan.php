<?php

/**
* 
*/
class Pengaturan extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array(''));
	}

	public function index()
	{
		// 
		$this->render('petugas/pengaturan/index');
	}

	public function tambah()
	{
		dump('ini tambah');
	}

}