<?php

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
    }

	public function index_post()
	{
		$data = array(
			'username' => $this->post('username');
			'password' => md5($this->post('password'));

		);
		return $this->response($data, 200);

        // $insert = $this->db->insert('user', $data);
        // if ($insert) {
        //     $this->response($data, 200);
        // } else {
        //     $this->response(array('status' => 'fail', 502));
        // }		
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */