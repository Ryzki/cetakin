<?php

/**
*
*/
class Homepage extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array('token_user_model'));
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();

		if ($user != NULL) {
			$data['status_token'] = $this->token_user_model->where('id_users', $user->id)->count_rows();
		} else {
			$data['status_token'] = 0;
		}

		$this->render('home', $data);
	}

	public function store_token()
	{
		$user 			   = $this->ion_auth->user()->row();

		$data['id_users'] = $user->id;
		$data['token'] 		= $this->input->post('token');
		$this->token_user_model->insert($data);
	}
}
